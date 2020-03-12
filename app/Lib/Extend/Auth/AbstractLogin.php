<?php 
namespace Extend\Auth;

use Extend\Validator\Captcha;
use BetterValidator;
use Illuminate\Support\Facades\Auth;
use Nova\User\Models\User;
abstract class AbstractLogin
{

	protected $email;

	protected $password;

	protected $validator;
	
	public function setDependency($email, $password)
	{
		$this->email = $email;
		$this->password = $password;
		return $this;
	}

	public function login()
	{
    	
    	$checkUser = User::where('email', '=', $this->email)->count();
    	if($checkUser == 0)
    	{
    		throw new \Extend\Auth\Exception\WrongEmailException;
    	}

		$user = array(
			'email' => $this->email,
			'password' => $this->password
		);
		
		if(Auth::guard("web")->attempt($user))
        {
    		
    		\Extend\Validator\Captcha::reset("AmoLogin@login");

    		return Auth::guard("web")->user();
    	}

    	throw new \Extend\Auth\Exception\AttempFailedException;
	}

}