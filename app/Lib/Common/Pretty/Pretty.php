<?php 
namespace Trihtm\Pretty;

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;


use Trihtm\Pretty\PrettyHelper as PHelper;
use Illuminate\Support\Facades\Config as Config;

use Session;
use Input;
use Illuminate\Support\Facades\URL;

class Pretty
{
	
	public static function urlLoginFB(){
		
		FacebookSession::setDefaultApplication(Config::get('oauth.providers.Facebook.keys.id'),Config::get('oauth.providers.Facebook.keys.secret'));
		
		$helper = new FacebookRedirectLoginHelper(URL::route('user.login.facebook'),Config::get('oauth.providers.Facebook.keys.id'),Config::get('oauth.providers.Facebook.keys.secret'));
		
		$loginUrl = $helper->getLoginUrl(array('email'));
		
		return $loginUrl;
		
	}
	
	public static function secret($secret)
	{
		$k = '';

		for($i = 0; $i < (strlen($secret) - 2); $i ++)
		{
			$k .= '*';
		}

		$s = substr_replace($secret, $k, 2);

		return $s;
	}

	public static function email($email, $noHide = false)
	{
		if(strpos($email, '@') === FALSE)
		{
			return $email;
		}

		list($name, $sub) = explode('@', $email);

		if($noHide)
		{
			return $name.'@'.$sub;
		}

        $name = substr_replace($name, '****', strlen($name) - 4);
        $sub  = substr_replace($sub, '***', 0, 3);

        return $name.'@'.$sub;
	}

	public static function mobile($mobile, $noHide = false)
	{
		$mobile = substr_replace($mobile, '0', 0, 2);

		if($noHide)
		{
			return $mobile;
		}

        return substr_replace($mobile, '****', strlen($mobile) - 4);
	}

	public static function preventID($id)
	{
		return substr_replace($id, '***', strlen($id) - 3);
	}
	
	/*
	 * Random password
	 */
	public static function mt_rand_str ($l, $c = '0123456789') {
	
		for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
		return $s;
	}
	
	
	public static function time($time)
	{
		if(!is_numeric($time))
		{
			$time = strtotime($time);
		}

		$now    = $_SERVER['REQUEST_TIME'];

	    $delta  = $now - $time;

	    if($delta > 3600 * 24)
	    {
	        return static::fullTime($time);
	    }

	    if($delta > 3600)
	    {
	        return static::roundUp($delta / 3600) .' giờ trước';
	    }

	    if($delta > 60)
	    {
	        return static::roundUp($delta / 60) .' phút trước';
	    }

	    return $delta.' giây trước';
	}

	public static function time_reserve($time)
	{
		if(!is_numeric($time))
		{
			$time = strtotime($time);
		}

	    $seconds = $time;
	    $day 	 = floor($seconds / (24 * 3600));
	    $hs  	 = floor($seconds / 3600 % 24);
	    $ms  	 = floor($seconds / 60 % 60);
	    $sr  	 = floor($seconds / 1 % 60);

	    if ($hs < 10) { $hh = "" . $hs; } else { $hh = $hs; }
	    if ($ms < 10) { $mm = "" . $ms; } else { $mm = $ms; }
	    if ($sr < 10) { $ss = "" . $sr; } else { $ss = $sr; }

	    $time  = '';
	    $time .= ($day != 0) ? $day . ' ngày ' : '';
	    $time .= ($hs  != 0) ? $hh . ' giờ '   : '';

	    if($day == 0)
	    {
	        $time .= ($ms  != 0) ? $mm . ' phút ' : '';

	        if($ss > 0 && $ms == 0)
	        {
	        	$time .= $ss . ' giây';
        	}
	    }

	    return $time;
	}

	// public static function fullTime($time = '')
	// {
	// 	if(!is_numeric($time))
	// 	{
	// 		$time = strtotime($time);
	// 	}

	// 	$date = new \Datetime;

	// 	if($time != '')
	// 	{
	// 		$date->setTimestamp($time);
	// 	}

 //    	return $date->format('H').'h'.$date->format('i').' '.$date->format('d/m/y');
	// }

	public static function fullTime($time = '')
	{
		$date = new \Datetime;

		if($time != '')
		{
			if(!is_numeric($time))
			{
				$time = strtotime($time);
			}

			$date->setTimestamp($time);
		}

    	return $date->format('H').'h'.$date->format('i').' '.$date->format('d-m-Y');
	}

	public static function miniTime($time = '')
	{
		$date = new \Datetime;

		if($time != '')
		{
			if(!is_numeric($time))
			{
				$time = strtotime($time);
			}

			$date->setTimestamp($time);
		}

    	return $date->format('H').'h'.$date->format('i').' '.$date->format('d-m');
	}

	public static function shortTime($time = '')
	{
	    $date = new \Datetime;

		if($time != '')
		{
			$date->setTimestamp($time);
		}

		return $date->format('H').'h'.$date->format('i');
	}

	public static function url($url)
	{
	    $url = Phelper::unicode_str_filter($url);

	    $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
	    $url = trim($url, "-");
	    $url = iconv("utf-8", "utf-8//TRANSLIT", $url);
	    $url = strtolower($url);
	    $url = preg_replace('~[^-a-z0-9_]+~', '', $url);

	    return $url;
	}

	public static function str($string, $length)
	{
		if(isset($string[$length]))
	    {
	        $k = explode(' ',substr($string,0,$length));

	        unset($k[count($k) - 1]);

	        return implode(' ',$k).'...';
	    }

	    return $string;
	}

	public static function shortDate($datetime)
	{
		$k = substr($datetime, 0, 10);
		$k = explode('-',$k);

        list($k[0],$k[1], $k[2]) = array($k[2],$k[1], $k[0]);

        return implode('/',$k);
	}

	public static function asset($path)
	{
		return Config::get('chamhoc.url.style').$path;
	}

	public static function number($n, $floor = true)
	{
	    if ($floor)
	        $n = floor($n);

	    return number_format($n, 0, ",", ".");
	}

	public static function slug($prety)
	{
	    $prety = static::filter_unicode($prety);

	    $prety = preg_replace('~[^\\pL0-9_]+~u', '-', $prety);
	    $prety = trim($prety, "-");
	    $prety = iconv("utf-8", "us-ascii//TRANSLIT", $prety);
	    $prety = strtolower($prety);
	    $prety = preg_replace('~[^-a-z0-9_]+~', '', $prety);

	    return $prety;
	}

	public static function check_slug($slug,$pretty)
	{
		if($slug != static::slug($pretty))
		{
			return false;
		}

		return true;
	}

	public static $badWord = '9chau,zing_9chau_,soha_,truongsa,hoang sa,tham nhũng,tham nhung,thamnhung,trường sa,truong sa,hoàng sa,hoangsa,chiến tranh,chien tranh,chientranh,sex,shit,dick,
        porn,fuck,tình dục,giao cấu,địt,dit,lồn,buồi,loạn luân,loan luan,soi cầu,lô đề,ho chi minh,cộng sản,congsan,cong san,hồ chí minh,
        cụ hồ,hochiminh,bác hồ,bacho,bac ho,đảng,đảng cộng sản,dangcongsan,công an,congan,cảnh sát,canhsat,
        canh sat,lật đổ,latdo,lat do,trung ương,trung uong,nhà nước,bộ truyền thông,bo truyen thong,botruyenthong,nguyentandung,nguyễn tấn dũng,
        dinhlathang,đinh la thăng,chính trị,chinh tri,cách mạng,cach mang,dm,dmm,dcm,clgt,vkl,vcl,dcmm,chính quyền,lậu,chinh quyen,chinhquyen,chínhquyền,
        mẹ mày,fuck,địt mẹ mày,địt,lồn,wtf,wth,what the fuck,what the hell,tổ sư,fgame,amo,admin,gamemaster,moderator,quantri,hotro,administrator,zmo';

	public static function checkWordClean($string)
	{
		$pool = static::$badWord;

        $badWord   = explode(',',$pool);

        foreach($badWord as $word)
        {
        	$wordRules = str_replace(' ', '', $word);

        	if(preg_match("/{$word}/", $string))
        	{
        		return false;
        	}
    	}

    	return true;
	}

	# Thuật toán loại bỏ từ xấu trong mảng 1 cách chính xác
    public static function badWord($string)
    {
        $pool = static::$badWord;

        $badWord   = explode(',',$pool);

        $string_ex = explode(' ',$string);

        foreach($string_ex as $key => $value)
        {
            foreach($badWord as $word)
            {
                $word 		= utf8_encode(trim($word));
                $word_ex 	= explode(' ',$word);
                $countWord 	= count($word_ex);
                $string_compare = '';

                for($i = 0;$i < $countWord;$i++)
                {
                	if(isset($string_ex[$key + $i]))
                	{
                    	$string_compare .= utf8_encode(strtolower($string_ex[$key + $i])).' ';
                	}
                }

                $string_compare = substr_replace($string_compare,'',-1);

                if($string_compare === $word)
                {
                    for($i = 0;$i < $countWord;$i++)
                    {
                    	$string_ex[$key + $i] = static::replaceToStar(static::filter_unicode($string_ex[$key + $i]));
                    }

                    break;
                }
            }
        }

        $string_return = implode(' ',$string_ex);

        return trim($string_return);
    }

    private static function replaceToStar($string)
    {
        $count = strlen(static::filter_unicode($string));

        $string_re = '';

        for($i = 0;$i < $count;$i++)
        {
            $string_re .= '*';
        }

        return $string_re;
    }

	public static function filter_unicode($str)
	{
	    $unicode = array(
	        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
	        'd'=>'đ',
	        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
	        'i'=>'í|ì|ỉ|ĩ|ị',
	        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
	        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
	        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
	        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
	        'D'=>'Đ',
	        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
	        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
	        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
	        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
	        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
	    );

	    foreach($unicode as $nonUnicode=>$uni){
	        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
	    }

	    return $str;
	}

	private static function roundUp($value, $precision = 0)
	{
	    $precisionFactor = ( $precision == 0 ) ? 1 : pow( 10, $precision );
	    return ceil( $value * $precisionFactor )/$precisionFactor;
	}

	public static function round($n,$d = 2,$o = false)
	{
	    $m = round($n * pow(10,$d),$d) / pow(10,$d);
	    if($o)
	    {
	        $m = number_format($m, $d, ".", ".");
	    }else{
	        $m = number_format($m, $d, ",", ".");
	    }
	    return $m;
	}
}

?>