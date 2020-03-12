<?php
namespace Extend\Transfer;
use Request;
use Trihtm\Curl\Curl;
use TrackingPay;

class LongHon {
    static $game_id = 25;
    static $key_api = 't1F53Jz+D8ymhsns';
    static $main_api = 'http://10.0.0.175/idamo/';
    public static function make_sig($arr,$key,$flag='flag'){
        ksort($arr);
        $_query_str = array();
        foreach ($arr as $_tmp_key => $_tmp_val) $_query_str[] = $_tmp_key.'='.$_tmp_val;
        return md5(rawurlencode(implode('&', $_query_str)).$key);
    }
    /**
     * API Login
     * @param  [string] $userName: [user_name]
     * @param  [int] $serverId:   [ServerID]
     * @param  int $adult:  0|1 [Truyền 0 biểu thí gamer cần chống nhiện game, không truyền hoặc truyền 1 tức là ko cần]
     */
    public static function payment($serverId, $user_id, $identity, $orderId, $money, $gold, $partner = 'aMO', $userName){
        $response = 'RESULT:999@CallApiFalse';
        $gameId 	= self::$game_id;
        if(strlen($userName) >20){
            $response = 'RESULT:999@InvalidUserMaxLength';
        }
        if($partner == 'Zing')
        {
            $serverId = ($serverId < 300) ? $serverId + 300 : $serverId;
        }
        $domain = 's'.$serverId.'.lh.amo.vn';
        $key = self::$key_api;
        $time = $_SERVER['REQUEST_TIME'];
        $arrParam = array(
            'domain'    => $domain,
            'money'     => $gold,
            'order'     => $orderId,
            'time'      => $time,
            'user'      => $userName
        );
        $flag = self::make_sig($arrParam, $key);
        $api = 'http://api.lh.amo.vn/pay?';
        $url = $api.http_build_query($arrParam).'&flag='.$flag;
        $result = @file_get_contents($url);
        $result = json_decode($result,true);
        switch($result['ret']){
            case 0:
                if(isset($result['msg']) && $result['msg'] == 'OK'){
                    $response = 'RESULT:00@Done';
                    // Done, tracking in background.
                    $param = array(
                        'TxtGameID'	  => $gameId,
                        'TxtServerID' => $serverId,
                        'TxtUsername' => $userName,
                        'TxtCash' 	  => $money,
                        'TxtGold' 	  => $gold,
                        'TxtTransID'  => $orderId,
                        'TxtIP'		  => Request::getClientIp(),
                        'created_at'  => new \Datetime
                    );

                    //DB::table('pay_log')->insert($param);
                    ///TrackingPay/Model/TrackingPay::create();
                    //TrackingPay::create($param);
                    $url = self::$main_api.'api-platform/tracking-transfer?'.http_build_query($param);
                    Curl::backgroundHttpGet($url);
                }else{
                    $response = 'RESULT:999@Error'.str_replace(' ','',$result['msg']);

                }
                break;
            case 1:
                $response = 'RESULT:200@InvalidParameter';
                break;
            case 2:
                $response = 'RESULT:201@InvalidRequireParameter';
                break;
            case 3:
                $response = 'RESULT:202@ServerGameNotExits';
                break;
            case 4:
                $response = 'RESULT:203@InvalidSign';
                break;
            case 5:
                $response = 'RESULT:03@FigureNotExist';
                break;
            case 101:
                $response = 'RESULT:204@Pending';
                break;
            case 102:
                $response = 'RESULT:205@Busy';
                break;
            case 103:
                $response = 'RESULT:04@OrderRealyExist';
                break;
            default:
                $response = 'RESULT:999@Error'.$result['ret'].$result['msg'];
                break;
        }
        return $response;
    }
} 