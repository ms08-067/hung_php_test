<?php namespace Trihtm\SMS;

use Game;
use DB;
use Exception;
use Pretty;
use Datetime;

/**
 ****
 * Syntax: ADP CODE KIEMDIEP 1
 */
class GetGiftcodeGame implements SMSInterface
{
	public $mode = 'code';
	public $user;

	protected $code;
	protected $game;
	
	public function setUser(\User $user)
	{
		$this->user = $user;
	}
	
	public function setGame($namespace)
	{
		$game = Game::where('namespace_short', '=', $namespace)->first();
			
		if(!$game)
		{
			throw new Exception("He thong aMO khong co game nay. Vui long kiem tra lai", 600);
		}
			
		$this->game = $game;
		
	}
	
	public function mainRules(\SmsLog $smsLog)
	{
		# Kiểm tra xem còn code hay ko
		
		if($this->game->id == 21){
			
			$count = DB::connection('id_event')->table('list_giftcode')
						->where('game_id', '=', $this->game->id)
						->whereNull('misdn')
						->where('type', '=', 'sms')
						->where('events_giftcode_id', '=', 15)
						->count();
		}
		else {
			$count = DB::connection('id_event')->table('list_giftcode')
						->where('game_id', '=', $this->game->id)
						->whereNull('misdn')
						->where('type', '=', 'sms')
						->count();
		}
		
		if($count <= 0)
		{
			throw new Exception("Da het Giftcode trong kho. Vui long lien he CSKH qua Hotline 0466.860.806",600);
		}

		# Kiểm tra xem SĐT này đã nhận Code game này chưa.
		$count = DB::connection('id_event')->table('list_giftcode')
				->where('game_id', '=', $this->game->id)
				->where('type', '=', 'sms')
				->where('misdn', '=', $smsLog->misdn)
				->count();
				
		if($this->game->id == 21){
			$count = DB::connection('id_event')->table('list_giftcode')
						->where('game_id', '=', $this->game->id)
						->where('type', '=', 'sms')
						->where('misdn', '=', $smsLog->misdn)
						->where('events_giftcode_id', '=', 15)
						->count();
		}		

		if($count > 0)
		{
			throw new Exception("Giftcode da duoc gui ve so dien thoai nay. Vui long kiem tra lai tin nhan.",600);
		}
	}

	public function mainAction(\SmsLog $smsLog)
	{
		# Lấy Code
		$data = DB::connection('id_event')->table('list_giftcode')
										->whereNull('misdn')
										->where('game_id', '=', $this->game->id)
										->where('type', '=', 'sms')
										->first();
		
		if($this->game->id == 21){
			
			$data = DB::connection('id_event')->table('list_giftcode')
						->whereNull('misdn')
						->where('game_id', '=', $this->game->id)
						->where('type', '=', 'sms')
						->where('events_giftcode_id', '=', 15)
						->first();
		}								
		
		$this->code = $data->code;
		
		//Game Tao thao
		if($this->game->id == 14)
		{
			throw new Exception("Da het thoi gian su kien phat Giftcode Game Tao Thao. Xem them https://id.amo.vn/giftcode.html",600);
		}
		
		else if($this->game->id == 21){
			//throw new Exception("Da het thoi gian su kien phat Giftcode Game Long Mon. Xem them https://id.amo.vn/giftcode.html",600);
			# Cập nhật mã code
			$update = DB::connection('id_event')->table('list_giftcode')
						->where('code', '=', $this->code)
						->where('events_giftcode_id', '=', 15)
						->update(array(
							'misdn'		=> $smsLog->misdn,
							//'user_id'   => $smsLog->user_id,
							//'username'  => $this->user->username,
							'got_at' 	=> new \Carbon\Carbon
						));
		}
		
		else {
			
			# Cập nhật mã code
			$update = DB::connection('id_event')->table('list_giftcode')->where('code', '=', $this->code)->update(array(
			'misdn'		=> $smsLog->misdn,
			//'user_id'   => $smsLog->user_id,
			//'username'  => $this->user->username,
			'got_at' 	=> new \Carbon\Carbon
			));
		}
		
	}

	public function getErrorText()
	{
		throw new Exception("Co loi xay ra trong qua trinh nhan code. Vui long lien he CSKH qua Hotline 0466.860.806", 600);
	}

	public function getSuccessText()
	{
		
		
		if($this->game->id == 14)
		{
			return "Da het thoi gian su kien phat Giftcode Game Tao Thao. Xem them https://id.amo.vn/giftcode.html";
		}
		
		if($this->game->id == 21)
		{
			//return 'He thong da dung phat giftcode Game Long Mon';		
			return $this->code." Code Lanh Huyet dung Closed Beta (".$this->game->homepage_url.")";
		}
		else 
		{
			return "Code ".Pretty::filter_unicode($this->game->game_name)." la ".$this->code." . Trang chu: ".$this->game->homepage_url;
		}		
		
	}
}