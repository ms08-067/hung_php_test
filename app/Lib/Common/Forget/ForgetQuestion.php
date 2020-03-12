<?php 
namespace Trihtm\Forget
use Exception;
use App;
use UserForget;
use Input;
use Session;

class ForgetQuestion{

	public function getUser()
	{
		$username = Session::get('UsernameResetPassword');

		$user = User::where('username', '=', $username)->first();

		return $user;
	}

	public function checkState()
	{
		if(!Request()->has('state'))
		{
			App::abort(404);
		}

		if(!Session::has('UsernameResetPassword'))
		{
			App::abort(404);
		}

		if(!Session::has('StateChangePass'))
		{
			App::abort(404);
		}

		if(Request()->input('state') != Session::get('StateChangePass'))
		{
			App::abort(404);
		}
	}

	public function forgetState( \Nova\User\Models\User $user)
	{
		Session::forget('StateChangePass');
		Session::forget('UsernameResetPassword');
	}

	public static function checkSecretQuestion( \Nova\User\Models\User $user, $question, $answer)
	{
		if($user->question != $question || strtolower(trim($user->answer)) != strtolower(trim($answer)))
		{
			throw new Exception("Thông tin câu hỏi bí mật không chính xác.", 600);
		}

		return true;
	}
}