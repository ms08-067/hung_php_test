<?php namespace Trihtm\SMS;

class ChargeCash
{
	public $mode = 'charge';
	public $user;

	protected $cash = 0;

	public function setUser(\User $user)
	{
		$this->user = $user;
	}

	public function mainRules(\SmsLog $smsLog)
	{
		$cash = $this->switchCash($smsLog->amount);
		$smsLog->setCash($cash);	
		
		$this->cash = $cash;
		
		
	}

	public function mainAction(\SmsLog $smsLog)
	{
		$wallet = new \Trihtm\Wallet\WalletRepository($smsLog->user_id);
		$wallet->addCash($smsLog->cash);
	}

	public function getErrorText()
	{
		throw new Exception("Co loi xay ra trong qua trinh nap tien. Vui long lien he CSKH qua Hotline 0466.860.806", 600);
	}

	public function getSuccessText($smsLog)
	{
		$cash = $this->cash;
		if($cash > 0 )
		{
			return "Ban nhan duoc ".$cash." Cash trong tai khoan ".$this->user->username.". Vui long kiem tra tren id.amo.vn";
		}	
		else {
			return "Ban chua nhan duoc Cash do gia tien khong hop le. Vui long kiem tra tren id.amo.vn";
		}
	}

	private function switchCash($amount)
	{
		switch ($amount)
		{
			case '1000':
				return 1;
				break;
				
			case '10000':
				return 55;
			break;

			case '20000':
				return 110;
			break;
			
			case '30000':
				return 165;
				break;

			case '50000':
				return  275;
			break;
			
			case '100000':
				return 550;
				break;
			
			default:
				return 0;
			break;
		}
	}
	
}