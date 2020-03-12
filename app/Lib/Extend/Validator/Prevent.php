<?php namespace Extend\Validator;

use Cache;
use Request;

class Prevent
{
	public static $minutes = 15; // prevent X minutes
	public static $limit   = 5; // X times wrong

	public static function makeKey($key, $user_id = 0)
	{
		$clientIp = Request::getClientIp();

		$key 	  = md5($clientIp. $key. $user_id);

		return $key;
	}

	public static function onFailure($key)
	{
		if(Cache::has($key))
		{
			if(\Config::get('cache.driver') == 'database')
			{
		    	Cache::put($key, Cache::get($key) + 1, static::$minutes);
			}else{
		    	Cache::increment($key);
	    	}
		}else{
			Cache::put($key, 1, static::$minutes);
		}
	}

	public static function onSuccess($key)
	{
		if(Cache::has($key))
		{
			Cache::forget($key);
		}
	}

	public static function checkFailed($key)
	{
		$times = 0;

		if(Cache::has($key))
		{
			$times = Cache::get($key);
		}

		return ($times >= static::$limit) ? true : false;
	}
}