<?php 
namespace Extend\Validator;

use Cache;
use Request;
use Input;
use Response;

use Image;
use Session;

class Captcha
{
	public static $minutes = 5;
	public static $limit   = 5;

	public static function showCaptcha($key)
	{
		$clientIp = Request::getClientIp();
		$key 	  = md5($clientIp.$key);

		if(!Cache::has($key))
		{
			return false;
		}

		return (Cache::get($key) >= static::$limit) ? true : false;
	}

	public static function update($key)
	{
		$clientIp = Request::getClientIp();
		$key 	  = md5($clientIp.$key);

		if (Cache::has($key))
		{
		    if(\Config::get('cache.driver') == 'database')
			{
		    	return Cache::put($key, Cache::get($key) + 1, static::$minutes);
			}else{
		    	return Cache::increment($key);
	    	}
		}

		return Cache::put($key, 1, static::$minutes);
	}

	public static function reset($key)
	{
		$clientIp = Request::getClientIp();
		$key 	  = md5($clientIp.$key);

		return Cache::forget($key);
	}

	public static function render()
	{
		// generate code
		$rand = array();

		for($i = 1; $i <= 4; $i ++)
		{
			$rand[] = mt_rand(1,9);
		}

		$text_captcha = implode('', $rand);
		
		// Không để flash bởi vì có 1 lỗi lạ, nếu load ajax trước khi submit thì ko reflash đc mà die
        Session::put('TxtCaptcha', $text_captcha); 


		// Make images
		$width 	= Request()->input('width', 278);
		$height = Request()->input('height',50);

		$img 	 = Image::canvas($width, $height, "#F4F4F4");

		foreach($rand as $index => $number)
		{			
			$wIndex = $index * 20;
			$hIndex = mt_rand(-10, 10);
			$img->text($number, $width / 2 - 43 + $wIndex, $height / 2 + 14 + $hIndex, function ($font) {
				$pool_color = array('#999', '#F60', '#a35555', '#5589a3', '#cbdb1f', '#cf2cc7');
				$color  = $pool_color[mt_rand(0, count($pool_color) - 1)];
				$angle  = mt_rand(-15, 30);
				$font->file(realpath('./packages/main/fonts/office/segoeuil-webfont.ttf'));
			    $font->size(28);
			    $font->color($color);			   
			    $font->angle($angle);
			});
		}

		return $img->response();
	}

	public static function forget()
	{
		\Session::forget('TxtCaptcha');
	}
}