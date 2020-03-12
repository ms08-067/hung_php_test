<?php 
namespace Trihtm\Common;

use User;
use Mail;
use Exception;
use Nova\User\Models\UserEmail;
use Datetime;
use URL;
use Pretty;
use UserPassword;
use Hash;
use DB;

class AppRepository
{

	private static $instance;

	/*
	 * Declared construct as protected for prevent create new Instance via new operator
	 */
	protected function __construct(){}
	public static function getInstance(){
		if(!isset(static::$instance)){
			static ::$instance = new self();
		}
		return static ::$instance;
	}
	/*
	 * The magic method __clone() is declared as private to prevent cloning of an instance of the class via clone operator
	 */
	private function __clone(){}
	/*
	 * The magic method __wakeup() is declared as private to prevent unserializing of instance of the class via the global function unserialize()
	 */
	private function __wakeup(){}
	
	public function parserString($content, array $data) {

		  if (!empty($content)) {
			   foreach ( $data as $k=>$v ) {
			    	$content = str_replace("{{".$k."}}", $v, $content);
			   }   
		  }
		  return $content;
	}

	public function generateRandom($length = 8, $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789")
    {
        $size = strlen($chars);
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $size - 1)];
        }
        return $str;
    }

    // chặn những mã xml sinh ra khi copy paste từ file ms word
	public function strip_word_html($text, $allowed_tags = '<b><i><sup><sub><em><strong><u><br>')
	{
		mb_regex_encoding('UTF-8');
		//replace MS special characters first
		$search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u');
		$replace = array('\'', '\'', '"', '"', '-');
		$text = preg_replace($search, $replace, $text);
		//make sure _all_ html entities are converted to the plain ascii equivalents - it appears
		//in some MS headers, some html entities are encoded and some aren't
		$text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
		//try to strip out any C style comments first, since these, embedded in html comments, seem to
		//prevent strip_tags from removing html comments (MS Word introduced combination)
		if(mb_stripos($text, '/*') !== FALSE){
			$text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm');
		}
		//introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be
		//'<1' becomes '< 1'(note: somewhat application specific)
		$text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text);
		$text = strip_tags($text, $allowed_tags);
		//eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one
		$text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text);
		//strip out inline css and simplify style tags
		$search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu');
		$replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>');
		$text = preg_replace($search, $replace, $text);
		//on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears
		//that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains
		//some MS Style Definitions - this last bit gets rid of any leftover comments */
		$num_matches = preg_match_all("/\<!--/u", $text, $matches);
		if($num_matches){
			$text = preg_replace('/\<!--(.)*--\>/isu', '', $text);
		}
		return $text;
	}

	public function emailActiveAccount( \Nova\User\Models\User $user)
	{
		ini_set('max_execution_time', 600);
		$template = \Nova\Common\Models\EmailTemplate::where('slug','email_active_account')->first();
		
		if(!empty($template)){
			
			$data = array(
				"l_name" => "<strong>".ucwords($user->username)."</strong>",
				"active_link"  => "<a target='_blank' href='".route('user.activeAccount')."?key=".$user->active_key."' >". route('user.activeAccount') ."?key=".$user->active_key."</a>"
			);

			$content = $this->parserString($template->content, $data);
			try{
				Mail::send([], [], function($message) use ($template, $user,$content)
				{
					$message->to($user->email, $user->email);
					$message->subject($template->subject." - ".date("d-m-Y H:i"));
					$message->setBody($content, 'text/html');
				});
				//$user->updateLogActivity("Send email email_active_account.");

			}catch(Exception $e){
				throw new Exception("Quá trình gửi email thất bại. Vui lòng thử lại.", 600);
			}
		}

	}

	public function emailNotifyPassword( \Nova\User\Models\User $user, $temp_password = "")
	{
		ini_set('max_execution_time', 600);
		$template = \Nova\Common\Models\EmailTemplate::where('slug','email_notify_password')->first();
		
		if(!empty($template)){
			
			$data = array(
				"email" => "<strong>".$user->email."</strong>",
				"temp_password" => $temp_password,
				"link_change_password"  => "<a target='_blank' href='".route('user.change.password')."' >".route('user.change.password')."</a>"
			);

			$content = $this->parserString($template->content, $data);
			try{
				Mail::send([], [], function($message) use ($template, $user,$content)
				{
					$message->to($user->email, $user->email);
					$message->subject($template->subject." - ".date("d-m-Y H:i"));
					$message->setBody($content, 'text/html');
				});

			}catch(Exception $e){
				throw new Exception("Quá trình gửi email thất bại. Vui lòng thử lại.", 600);
			}
		}

	}

	public function emailForgetPassword( \Nova\User\Models\User $user)
	{
		ini_set('max_execution_time', 600);
		$template = \Nova\Common\Models\EmailTemplate::where('slug','email_forget_password')->first();
		
		if(!empty($template)){
			
			$data = array(
				"l_name" => "<strong>".ucwords($user->l_name)."</strong>",
				"email"  => $user->email,
				"reset_password_link"  => "<a target='_blank' href='".route('user.setup.password')."?key=".$user->forget_key."' >". route('user.setup.password') ."?key=".$user->forget_key."</a>"
			);

			$content = $this->parserString($template->content, $data);
			try{
				Mail::send([], [], function($message) use ($template, $user,$content)
				{
					$message->to($user->email, $user->f_name." ".$user->l_name);
					$message->subject($template->subject." - ".date("d-m-Y H:i"));
					$message->setBody($content, 'text/html');
				});
				$user->updateLogActivity("Send email email_forget_password.");

			}catch(Exception $e){
				throw new Exception("Quá trình gửi email thất bại. Vui lòng thử lại.", 600);
			}
		}

	}

	public function sendingPassword( \Nova\User\Models\User $user, $password)
	{
		$key   = md5(md5(rand().$user->id.$password));

		$email = $user->email;

		$userPassword = UserPassword::create(array(
			'user_id' 		=> $user->id,
			'password' 		=> $password,
			'key'			=> $key,
			'created_at' 	=> new Datetime
		));

		$user->updateLogActivity("Gửi email xác nhận đổi mật khẩu.");

		// Gửi email
		$assign 	= array(
			'user' => $user,
			'url'  => URL::route('email.password', array('token' => $key)),
		);

		$template 	= 'emails.activePassword';

		try{
			Mail::send($template, $assign, function($message) use ($user, $email)
			{
				$message->to($email, $user->showName());

				$message->subject('Xác nhận đổi mật khẩu tài khoản '.$user->username.' - '.date('d/m/Y H:i:s'));
			});
		}catch(Exception $e){
			throw new Exception("Quá trình gửi email thất bại. Vui lòng thử lại.", 600);
		}
	}

	public function roundAny($n,$x=5) {
	    
	    $number = (round($n)%$x === 0) ? round($n) :  round($n/$x) * $x;;
	    return number_format($number,0,",",".");
	}

	public function estimateTime($date){

		$diff = time() - strtotime($date);

		if($diff < 60) return $diff ." giây trước.";
		if($diff < 3600 && $diff >= 60) return floor($diff/60). " phút trước.";
		if($diff < 86400 && $diff >= 3600) return floor($diff/3600). " giờ trước.";
		if($diff >= 86400) return floor($diff/86400) ." ngày trước.";
	}

	public function prettyString($str){

		$subject_none = \Trihtm\Pretty\Pretty::filter_unicode($str);
		$subject_none = str_replace("?","", $subject_none);

		$subject_none = str_replace(" ","-", trim($subject_none));
		return $subject_none;
	}

}