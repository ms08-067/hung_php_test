<?php 
namespace Extend\Auth\Login;
use Response;
use Redirect;
use URL;
use Session;
use Trihtm\SSO\SSO;
use Extend\Validator\Captcha;
use Extend\Auth\AbstractLogin;
use Auth;
use Datetime;
use Illuminate\Http\Request;
use App\Models\User;

class AmoLogin extends AbstractLogin
{
	protected $mode;

	protected $urlRedirect;

	function __construct()
	{
		$url 	 = URL::route('user.home');
    	$this->urlRedirect = $url;
	}

	protected function errorCaptchaCallback()
	{
		switch($this->mode)
		{
			case 'redirect':
    			return $this->returnRedirect($this->urlRedirect, 'Mã xác nhận không chính xác');
			break;

			case 'iframePopup':
    			return $this->returnJson('Mã xác nhận không chính xác.');
			break;

			default:
    			return Redirect::back()->withInput()->withErrors($this->validator);
			break;
		}
	}

	protected function successCallback($user, $bid)
	{ //echo "<pre>"; print_r($user); exit;
		$user->updateCampaignFrom($bid);
		$user->last_login_at = new Datetime;
		$user->save();

		switch($this->mode)
		{
			case 'redirect':
    			return $this->returnRedirect($this->urlRedirect, 'Thành công', true);
			break;

			case 'iframePopup':
    			return $this->returnJson('Thành công', true, array('url' => $this->urlRedirect));
			break;

			default:
				//Session::forget('url.intended');
    			//return Redirect::to($this->urlRedirect);
				return Redirect::route("video.index");
			break;
		}
	}

	protected function attempFailedCallback()
	{
		switch($this->mode)
		{
			case 'redirect':
    			return $this->returnRedirect($this->urlRedirect, 'Mật khẩu không chính xác.');
			break;

			case 'iframePopup':
    			return $this->returnJson('Mật khẩu không chính xác.');
			break;

			default:
    			return Redirect::back()->withInput()->with('flash_error_message', 'Your password incorrect.');
			break;
		}
	}

	protected function blockedCallback($message)
	{
		switch($this->mode)
		{
			case 'redirect':
    			return $this->returnRedirect($this->urlRedirect, $message);
			break;

			case 'iframePopup':
    			return $this->returnJson($message);
			break;

			default:
    			return Redirect::route('home')->withInput()->with('flash_error_message', $message);
			break;
		}
	}

	protected function managerAccessCallback()
	{
		switch($this->mode)
		{
			case 'redirect':
    			return $this->returnRedirect($this->urlRedirect, 'Tài khoản của bạn đang được bộ phận CSKH truy cập để kiểm tra.');
			break;

			case 'iframePopup':
    			return $this->returnJson('Tài khoản của bạn đang được bộ phận CSKH truy cập để kiểm tra.');
			break;

			default:
    			return Redirect::route('home')->withInput()->with('flash_error_message', 'Tài khoản của bạn đang được bộ phận CSKH truy cập để kiểm tra.');
			break;
		}
	}

	protected function wrongEmailCallback()
	{
		switch($this->mode)
		{
			case 'redirect':
    			return $this->returnRedirect($this->urlRedirect, 'Email not exists.');
			break;

			case 'iframePopup':
    			return $this->returnJson('Tài khoản không tồn tại.');
			break;

			default:
    			return Redirect::back()->withInput()->with('flash_error_message', 'Email not exists.');
			break;
		}
	}

	public function run($bid = 0)
	{ 
		if(Auth::guard("web")->check())
		{
			$user = Auth::guard("web")->user();
			return $this->successCallback($user, $bid);
		}

		try{

			$user = $this->login();
			return $this->successCallback($user, $bid);
			
		}catch(\Extend\Auth\Exception\CaptchaException $e)
		{
			return $this->errorCaptchaCallback();
		}
		catch(\Extend\Auth\Exception\AttempFailedException $e)
		{
			return $this->attempFailedCallback();
		}
		catch(\Extend\Auth\Exception\BlockedException $e)
		{
			return $this->blockedCallback($e->getMessage());
		}
		catch(\Extend\Auth\Exception\ManagerAccessException $e)
		{
			return $this->managerAccessCallback();
		}
		catch(\Extend\Auth\Exception\WrongEmailException $e)
		{
			return $this->wrongEmailCallback();
		}
	}

	private function returnJson($message, $code = false, $appends = array())
	{
		if($code)
		{
			$data = array(
				'sso_return_code' 	 	=> $code,
				'sso_return_message' 	=> $message,
				'sso_message_checksum' 	=> md5($message.'fgame2014amo')
			);

			$url = $appends['url'];

			$query_string = http_build_query($data);

			$source = parse_url($url);

			if(isset($source['query']))
			{
				$url .= '&'.$query_string;
			}else{
				$url .= '?'.$query_string;
			}

			$appends['url'] = $url;
		}

		$dataReturn = array_merge(array(
			'success' => $code,
			'message' => $message
		), $appends);

		return Response::json($dataReturn);
	}

	private function returnRedirect($url, $message, $code = false)
	{
		$data = array(
			'sso_return_code' 	 	=> $code,
			'sso_return_message' 	=> $message,
			'sso_message_checksum' 	=> md5($message.'fgame2014amo')
		);

		$key = 'AmoLogin@login';

		if(Captcha::showCaptcha($key))
		{
			$data['sso_show_captcha'] = true;
		}

		$query_string = http_build_query($data);

		$source = parse_url($url);

		if(isset($source['query']))
		{
			$url .= '&'.$query_string;
		}else{
			$url .= '?'.$query_string;
		}

		return Redirect::to($url);
	}
}