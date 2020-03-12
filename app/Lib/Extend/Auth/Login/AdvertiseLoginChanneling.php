<?php namespace Extend\Auth\Login;

use Auth;
use Input;
use Response;
use Redirect;
use URL;
use Session;
use Trihtm\SSO\SSO;
use Extend\Validator\Captcha;
use Extend\Auth\AbstractLogin;
use Datetime,DateInterval;
use Request;

class AdvertiseLoginChanneling extends AdvertiseLogin
{

	protected function successCallback($user, $bid)
	{
		$user->updateCampaignFrom($bid);
		$user->last_login_at = new Datetime;
		$user->save();

		$username = $user->username;
		$user_id	= $user->id;

		Auth::logout();

		$sign = '@Xindunglamphien!@#';

    	return Response::json(array(
        	'status' 			=> true,
        	'channeling_game' 	=> true,
        	'user_id'			=> $user_id,
        	'username' 			=> $username,
        	'time'				=> $_SERVER['REQUEST_TIME'],
        	'key'				=> md5($sign.$user_id.$username.$_SERVER['REQUEST_TIME']),
        	'campaign_id'		=> $bid,
        	'login_ip'			=> Request::getClientIp(),
    	));
	}
}