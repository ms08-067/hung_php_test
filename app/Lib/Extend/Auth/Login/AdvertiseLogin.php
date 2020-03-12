<?php namespace Extend\Auth\Login;

use Input;
use Response;
use Redirect;
use URL;
use Session;
use Trihtm\SSO\SSO;
use Extend\Validator\Captcha;
use Extend\Auth\AbstractLogin;
use Datetime,DateInterval;
use Campaign;
use Game;
use Request;

class AdvertiseLogin extends AbstractLogin
{
	protected function errorCaptchaCallback()
	{
		return Response::json(array('status' => false, 'message' => 'Mã xác nhận không chính xác.'));
	}

	protected function successCallback($user, $bid)
	{
		$user->updateCampaignFrom($bid);
		$user->last_login_at = new Datetime;
		$user->save();

		$username = $user->username;
		$user_id  = $user->id;

		try {
			$campaign = Campaign::findOrFail($bid);
		} catch (Exception $e) {
			return Response::json(array('status' => false, 'message' => 'Campagin hoặc game không chính xác'));
		}

    	return Response::json(array(
        	'status' 			=> true,
        	'user_id'			=> $user_id,
        	'username' 			=> $username,
        	'time'				=> $_SERVER['REQUEST_TIME'],
        	'login_ip'			=> Request::getClientIp(),
    	));
	}

	protected function attempFailedCallback()
	{
		return Response::json(array('status' => false, 'message' => 'Your password incorrect.'));
	}

	protected function blockedCallback($message)
	{
		return Response::json(array('status' => false, 'message' => $message));
	}

	protected function managerAccessCallback()
	{
		return Response::json(array('status' => false, 'message' => 'Tài khoản của bạn đang được bộ phận CSKH truy cập để kiểm tra.'));
	}

	protected function wrongUsernameCallback()
	{
		return Response::json(array('status' => false, 'message' => 'Tài khoản không tồn tại.'));
	}

	public function run($bid)
	{
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
		catch(\Extend\Auth\Exception\WrongUsernameException $e)
		{
			return $this->wrongUsernameCallback();
		}
	}
}