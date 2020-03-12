<?php namespace Trihtm\Referal;

class IP
{
	public static function allowedIpVN($ip)
	{
		$gi = geoip_open(__DIR__."\\GeoIP.dat",GEOIP_STANDARD);

		$code = geoip_country_code_by_addr($gi, $ip);

		geoip_close($gi);

		return ($code == 'VN') ? true : false;
	}
}