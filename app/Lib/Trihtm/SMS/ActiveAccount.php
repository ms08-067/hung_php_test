<?php namespace Trihtm\SMS;

use UserMobile;
use Datetime;
use User;
use Exception;
use Illuminate\Http\Response;

class ActiveAccount implements SMSInterface
{
	public $mode = 'active';
	public $user;

	protected $key;

	public function setUser(\User $user)
	{
		$this->user = $user;
	}

	public function mainRules(\SmsLog $smsLog)
	{
		# Mỗi số điện thoại chỉ có thể kích hoạt cho 1 tài khoản duy nhất
		$check = User::where('mobile', '=', $smsLog->misdn)->get();

		if(count($check) > 0)
		{
			throw new Exception("So dien thoai nay da duoc kich hoat cho mot tai khoan khac.",600);
		}
		
	    # Check xem tài khoản đã kích hoạt hay chưa
        if(!$this->user->canChangeMobile())
        {
        	throw new Exception("Tai khoan nay da kich hoat so dien thoai roi, khong the huy bo.",600);
     
        }
        
        # Xóa những record đã có
        UserMobile::where('user_id', '=', $this->user->id)->delete();
        
	}

	public function mainAction(\SmsLog $smsLog)
	{
		$this->key = substr(md5(md5(mt_rand().$this->user->id)), 5, 6);

		$userMobile = UserMobile::create(array(
			'user_id' 	 => $this->user->id,
			'misdn'   	 => $smsLog->misdn,
			'key'	  	 => $this->key,
			'created_at' => new Datetime
		));

	}

	public function getErrorText()
	{
		throw new Exception("Co loi xay ra trong qua trinh kich hoat. Vui long lien he CSKH qua Hotline 0466.860.806",600);
	}

	public function getSuccessText()
	{
		return "Ma kich hoat tai khoan cua ban la ".$this->key;
	}
}