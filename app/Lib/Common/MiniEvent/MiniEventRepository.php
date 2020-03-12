<?php namespace Trihtm\MiniEvent;

use Exception;
use FbFriend;
use DB;
use Datetime;

class MiniEventRepository
{
	public static $places_id = array(
		'106388046062960',
		'157805327690704',
		'183888868288744',
		'186962704665700',
		'168686473255563',
		'547980055223491',
		'108458769184495',
		'518824771491353',
		'544156325612502',
		'402822549840003',
	);

	public static function getPlaceID()
	{
		return static::$places_id[mt_rand(0, count(static::$places_id) - 1)];
	}

	public static function getFriends($facebook, $fb_user, $user)
	{
		$users_fb_total = FbFriend::where('user_id', '=', $user->id)->count();

		if($users_fb_total == 0)
		{
			$data = $facebook->api('/me/friends');
	        	
	    	if(!isset($data['data']))
	    	{
	    		throw new Exception("Bạn phải cho phép aMO quyền truy cập để tham gia event.", 600);        		        		        		
	    	}

	    	$friends = $data['data'];

	    	if(count($friends) == 0)
	    	{
	    		throw new Exception("Không tải được danh sách bạn bè.", 600);        		
	    	}

	    	try{
				DB::connection()->getPdo()->beginTransaction();

	        	foreach($friends as $index => $friend)
	        	{
	        		FbFriend::create(array(
	        			'user_id' => $user->id,
	        			'fb_id'	  => $fb_user['id'],
	        			'fb_ids'  => $friend['id'],
	        			'fb_name' => $friend['name'],
	        			'created_at' => new Datetime
	    			));    			
	        	}

	        	DB::connection()->getPdo()->commit();
	    	}catch(Exception $e) {
	        	DB::connection()->getPdo()->rollBack();

	        	throw new Exception("Có lỗi xảy ra trong quá trình tải danh sách bạn bè.", 600);            	
	    	}
    	}

    	$list_friends = array();

    	$users_fb = FbFriend::where('user_id', '=', $user->id)->orderBy(DB::raw('RAND()'))->take(48)->get();

    	foreach($users_fb as $user)
    	{
    		array_push($list_friends, $user['fb_ids']);
		}

		return $list_friends;
	}
}