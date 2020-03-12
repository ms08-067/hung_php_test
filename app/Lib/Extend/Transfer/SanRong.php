<?php
namespace Extend\Transfer;
use Request;
use Trihtm\Curl\Curl;
use Log;

class SanRong {
    static $game_id = 26;
    /**
     * API Transfer Cash To Gold
     * @param  [type] $server_id [description]
     * @param  [type] $username  [description]
     * @param  [type] $user_id   [description]
     * @param  [type] $order_id  [description]
     * @param  [type] $cash      [description]
     * @param  [type] $gold      [description]
     * @param  string $partner   [description]
     * @return [type]            [description]
     */
    static function payment($server_id, $user_id, $identity, $order_id, $cash, $gold, $partner = 'aMO', $username)
    {
        ini_set('max_execution_time', 300);
        $game_id = static::$game_id;
        $server_id = $server_id;
        if($partner == 'Zing')
        {
            $server_id = ($server_id < 300) ? $server_id + 300: $server_id;
        }
        $loginID = $user_id;
        $username = urlencode($username);
        $time = $_SERVER['REQUEST_TIME'];
        $serverID = $server_id;
        $key = 'xxEsxtumFpanvn%vxvKPTWNIw%ZPznMi';
        $money = $gold * 100;

        $sign=md5($username.$money.$gold.$server_id.$order_id.$key);

        $api = 'http://s'.$server_id.'.sr.amo.vn/exchange.php';

        $url = $api.'?passport='.$username.'&server_sn='.$serverID.'&money='.$money.'&coin='.$gold.'&order_id='.$order_id.'&time='.$time.'&sign='.$sign;
        //Log::info($url);
        //http://s999.vc.amo.vn/exchange.php?passport=123456&server_sn=999&money=100&coin=1000&order_id=1&time=13433333333&sign=aca62d0764b65ff4e6d7413576eb1f10
		
        //if($username == 'amoducpv'){
        //    dd($url);
        //}
        $result = @file_get_contents($url);
		//Log::error($result);
        //$result = json_decode($result);
        //if($username == 'zing_sangtv1'){
        //dd($result);
        //}

        switch($result)
        {
            default:
				Log::error($result);
                $response = 'RESULT:999@Error '.$result;
                break;

            case 1:
                $response = 'RESULT:00@Done';

                // Done, tracking in background.
                $param = array(
                    'TxtGameID'	  => $game_id,
                    'TxtServerID' => $server_id,
                    'TxtUsername' => $username,
                    'TxtCash' 	  => $cash,
                    'TxtGold' 	  => $gold,
                    'TxtTransID'  => $order_id,
                    'TxtIP'		  => Request::getClientIp(),
                    'created_at'  => new \Datetime
                );

                //DB::table('pay_log')->insert($param);

                $url = 'http://10.0.0.175/idamo/api-platform/tracking-transfer?'.http_build_query($param);

                Curl::backgroundHttpGet($url);
                break;

            case 3:
                $response = 'RESULT:201@Sign Error';
                break;

            case 2:
                $response = 'RESULT:03@Character is not exists';
                break;
        }

        return $response;
    }
} 