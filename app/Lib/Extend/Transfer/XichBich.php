<?php
namespace Extend\Transfer;
use Request;
use Trihtm\Curl\Curl;

class XichBich {
    static $game_id = 23;
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
        $key = '!bQ_&#37:57:18Dont|worry?be*happY!';

        $sign=md5(md5($username.$order_id.$gold.$server_id.$time.$key).$key);

        $api = 'http://api.xb.amo.vn:8001/pay';
        $url = $api.'?account='.$username.'&order='.$order_id.'&value='.$gold.'&serverid='.$serverID.'&time='.$time.'&sig='.$sign;
		
        //if($username == 'amoducpv'){
        //    dd($url);
        //}
        $result = @file_get_contents($url);
        //$result = json_decode($result);
        //if($username == 'zing_sangtv1'){
        //dd($result);
        //}
		
        switch($result)
        {
            default:
                $response = 'RESULT:999@Error '.$result;
                break;

            case 200:
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

            case 102:
                $response = 'RESULT:201@Sign Error';
                break;

            case 103:
            case 104:
                $response = 'RESULT:03@Character is not exists';
                break;

            case 109:
                $response = 'RESULT:04@OrderId was exists';
                break;
        }

        return $response;
    }
} 