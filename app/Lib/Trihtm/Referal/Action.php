<?php namespace Trihtm\Referal;

use Request;
use DB;
use Datetime;
use Exception;

class Action{

	public static function assignKey($key)
	{
		$own_ip = Request::getClientIp();

		$check = DB::table('event_3_ip')->where('key', '=', $key)->where('ip', '=', $own_ip)->first();

		if(!isset($check) || !$check)
		{
			try{
	        	DB::connection()->getPdo()->beginTransaction();

				if(IP::allowedIpVN($own_ip))
				{
					// cập nhật với state thành công
					DB::table('event_3_ip')->insert(array(
						'ip'  		 => $own_ip,
						'key' 		 => $key,
						'status' 	 => 1,
						'created_at' => new Datetime
					));

					$check = DB::table('event_3_point')->where('key', '=', $key)->first();

					if(!isset($check) || !$check)
					{
						DB::table('event_3_point')->insert(array(
							'key' 	=> $key,
							'point' => 1
						));
					}else{
						DB::table('event_3_point')->where('key', '=', $key)->increment('point');
					}
				}else{
					// cập nhật với state thất bại
					DB::table('event_3_ip')->insert(array(
						'ip'  		 => $own_ip,
						'key' 		 => $key,
						'status' 	 => 0,
						'created_at' => new Datetime
					));
				}
				
				DB::connection()->getPdo()->commit();
		    }catch (Exception $e) {
		        DB::connection()->getPdo()->rollBack();

		        dd($e->getMessage());
		    }
	    }
	}

}