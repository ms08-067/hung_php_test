<?php
namespace Extend\Transfer;
use Request, Config;
use Trihtm\Curl\Curl;

class MongAoCB {
    static $game_id = 29;
    static $key_api = 'EB6448BE60425DF4E44F5CF92BAB5DB4';
    static $main_api = 'http://10.0.0.175/idamo/';
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
    public static function payment($server_id, $user_id, $identity, $order_id, $cash, $gold, $partner = 'aMO', $username)
    {
    


        ini_set('max_execution_time', 300);
        $game_id    = static::$game_id;
        $server_id  = $server_id;
        if($partner == 'Zing')
        {
            $server_id = ($server_id < 300) ? $server_id + 300: $server_id;
        }
        $loginID    = $user_id;
        $username = urlencode($username);
        $time    = $_SERVER['REQUEST_TIME'];
        $serverID = $server_id;
        $key = self::$key_api;

        $sign=md5($username.$key);

        $api = 'http://123.30.150.49/pay';

        // $url = $api.'?username='.$username.'&gold='.$gold.'&orderid='.$order_id.'&time='.$time.'&flag='.$sign.'&sid='.$serverID;
        $url = $api.'?account='.$username.'&sid='.$serverID.'&orderId='.$order_id.'&gold='.$gold.'&sig='.$sign;

        $result = @file_get_contents($url);
        $result = json_decode($result);

        switch($result->ret)
        {
            default:
                $response = 'RESULT:999@Error_'.$result;
            break;
            
            case 0:
                $response = 'RESULT:00@Done';

                // Done, tracking in background.
                $param = array(
                    'TxtGameID'   => $game_id,
                    'TxtServerID' => $server_id,
                    'TxtUsername' => $username,
                    'TxtCash'     => $cash,
                    'TxtGold'     => $gold,
                    'TxtTransID'  => $order_id,
                    'TxtIP'       => Request::getClientIp(),
                    'created_at'  => new \Datetime
                );

                //DB::table('pay_log')->insert($param);

                $url = self::$main_api.'api-platform/tracking-transfer?'.http_build_query($param);

                Curl::backgroundHttpGet($url);
                // Trihtm\Curl\Curl::backgroundHttpGet($url);
            break;

            case 101:
                $response = 'RESULT:101@Lỗi hệ thống';
            break;

            case 102:
                $response = 'RESULT:03@Nhân vật không có';
            break;

            case 103:
                $response = 'RESULT:04@Sign lỗi';
            break;

            
        }

        return $response;
    }
} 