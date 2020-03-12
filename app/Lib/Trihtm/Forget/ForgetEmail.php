<?php namespace Trihtm\Forget;

use User;
use Exception;
use App;
use UserForget;
use Input;
use Session;
use Datetime,DateInterval;
use URL;
use Mail;
use Config;

class ForgetEmail{

	protected $forget;

	public function getUser($state)
	{
		$this->forget = UserForget::where('key', '=', $state)->first();

		if(!$this->forget)
		{
			throw new Exception("Token không chính xác.", 600);
		}

		if($this->forget->isExpired())
		{
			throw new Exception("Token đã hết hạn sử dụng. Vui lòng thực hiện lại.", 600);
		}

		$user = User::find($this->forget->user_id);

		if(!$user)
		{
			throw new Exception("Không tồn tại tài khoản này", 600);
		}

		return $user;
	}

	public function checkState()
	{
		if(!Request()->has('state'))
		{
			App::abort(404);
		}
	}

	public function forgetState(User $user)
	{
		UserForget::where('user_id', '=', $user->id)->delete();
	}
	/*
	public static function sendEmailValidation(User $user, $state)
	{
		$user->updateLogActivity("Gửi yêu cầu lấy lại mật khẩu qua email.");

		$time = new Datetime;
		$time->add(new DateInterval('PT1H'));

		UserForget::create(array(
			'key' 			=> $state,
			'user_id' 		=> $user->id,
			'expired_at' 	=> $time
		));

		$assign 	= array(
			'user' => $user,
			'url'  => URL::route('user.setup.password').'?state='.$state.'&modeEmail=1',
		);

		$template 	= 'emails.forget';

		try{
			Mail::send($template, $assign, function($message) use ($user)
			{
				# set sender
				$message->from(Config::get('mail.from.address'), 'aMO ID');

				$message->to($user->email, $user->showName());

				$message->subject('Thiết lập mật khẩu aMO ID - '.$user->username.' '.date('d/m/Y H:i:s'));
			});
		}catch(Exception $e){
			throw new Exception("Quá trình gửi email thất bại. Vui lòng thử lại.", 600);
		}
	}
	*/

}