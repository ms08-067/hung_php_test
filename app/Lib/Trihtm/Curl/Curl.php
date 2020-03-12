<?php namespace Trihtm\Curl;

class Curl
{
	public static function exec($url, $param = '')
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPhone; U; CPU iPhone OS 3_0 like Mac OS X; en-us) AppleWebKit/528.18 (KHTML, like Gecko) Version/4.0 Mobile/7A341 Safari/528.16');
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$param);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_COOKIE, '');
		curl_setopt($ch, CURLOPT_REFERER, '');
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$kq = curl_exec($ch);
		curl_close($ch);
		return $kq;
	}

	/**
    * Goi 1 async post request de khong delay cua main process
    *
    * @param mixed $url
    */
    public static function backgroundHttpPost($url, $paramString = '')
    {
        $parts = parse_url($url);

        if(strpos($url, 'https') !== FALSE)
        {
            $fp = fsockopen('ssl://'. $parts['host'], 443, $errno, $errstr, 30);
        }else{
            $fp = fsockopen($parts['host'], isset($parts['port']) ? $parts['port']:80, $errno, $errstr, 30);
        }

        if(!$fp) return false;

        $out = "POST ".$parts['path']."?".$parts['query']." HTTP/1.1\r\n";
        $out.= "Host: ".$parts['host']."\r\n";
        $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
        $out.= "Content-Length: ".strlen($paramString)."\r\n";
        $out.= "Connection: Close\r\n\r\n";


        if ($paramString != '') {
            $out.= $paramString;
        }

        fwrite($fp, $out);
        fclose($fp);

        return true;
    }

    /**
    * Goi 1 async get request de khong delay cua main process
    *
    * @param mixed $url
    */
    public static function backgroundHttpGet($url)
    {
        $parts = parse_url($url);

        if(strpos($url, 'https') !== FALSE)
        {
            $fp = fsockopen('ssl://'. $parts['host'], 443, $errno, $errstr, 30);
        }else{
            $fp = fsockopen($parts['host'], isset($parts['port']) ? $parts['port']:80, $errno, $errstr, 30);
        }

        if(!$fp) return false;

        $out = "GET ".$parts['path']."?".$parts['query']." HTTP/1.1\r\n";
        $out.= "Host: ".$parts['host']."\r\n";
        $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
        $out.= "Connection: Close\r\n\r\n";

        fwrite($fp, $out);
        fclose($fp);

        return true;
    }
}