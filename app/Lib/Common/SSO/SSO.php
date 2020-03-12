<?php 

namespace Trihtm\SSO;

use Config;
use URL;
use Auth;
use AuthorizationSSO;
use App\Models\AuthorizationRedirect as AuthorizationRedirect;

class SSO
{
	protected $safeLinks;
	protected static $instance;

	public function __construct()
	{
		$this->safeLinks = AuthorizationRedirect::parseOptionDomain();
	}

	public static function getInstance()
	{
		if(!isset(static::$instance))
		{
			static::$instance = new self;
		}

		return static::$instance;
	}

	public function sign($host, $string)
	{
		$secret = $this->safeLinks[$host];

		return md5(md5($string.$secret));
	}

	public function renderURL($url)
	{
		$source = parse_url($url);
		$source['path'] = isset($source['path']) ? $source['path'] : '';

		if(strpos($url, 'https') !== FALSE)
		{
			$target = 'https://'.$source['host'].$source['path'];
		}else{
			$target = 'http://'.$source['host'].$source['path'];
		}

		$user_id = 0;

		if(Auth::check())
		{
		  	$authen_param = array(
		  		'sso_user_id'			=> $user_id,
		  		'sso_user_name' 		=> Auth::user()->username,
		  		'sso_signal'			=> $this->sign($source['host'], $user_id.Auth::user()->username.date('dmYHi'))
	  		);
  		}else{
  			$authen_param = array(
  				'sso_authentication' => false
			);
  		}

	  	if(isset($source['query']))
	  	{
	  		$target .= '?'.$source['query'].'&'.http_build_query($authen_param);
	  	}else{
	  		$target .= '?'.http_build_query($authen_param);
  		}

  		return $target;
	}

	public function checkSafeLink($source)
	{
		if (filter_var($source, FILTER_VALIDATE_URL) === FALSE)
		{
		    return false;
		}

		// Make sure we're redirecting somewhere safe
		$source = parse_url($source);

		if(isset($this->safeLinks[$source['host']]))
		{
			return true;
		}

		return false;
	}
}