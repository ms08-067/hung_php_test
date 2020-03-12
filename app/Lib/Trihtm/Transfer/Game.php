<?php 
namespace Trihtm\Transfer;

use User;
use Exception;
use PayTransfer;
use Datetime;
use App\Models\Game as GameAll;
use Pretty;
use Tester;
use Illuminate\Support\Facades\DB;
class Game
{
	public static $discount = array(
		'100',
		'200',
		'300',
		'490',
		'500',

		'950',
		'1000',
		'2000',

		'5000',
		'10000',
		'20000',
		'50000',
	);

	protected $game;
	protected $user;

	protected static $instance;

	public static function getInstance()
	{
		if(!isset(static::$instance))
		{
			static::$instance = new self;
		}

		return static::$instance;
	}

	public function setUser($user)
	{
		$this->user = $user;

		return $this;
	}

	public function setGame($game)
	{
		$this->game = $game;

		return $this;
	}

	public function renderListGame($defaultValue = '')
	{
		if($this->user && $this->user->isTester())
		{
			$games = GameAll::all();
		}else{
			$games = GameAll::live()->isNotChanneling()->orderBy('publish_at', 'desc')->orderBy('id', 'desc')->get();
		}

		$list = array();

		$list[0] = 'Vui lòng chọn game';

		foreach($games as $index => $game)
		{
			$list[$game->id] = $game->game_name;
		}

		$html = '';

		foreach($list as $option => $name)
		{
			$selected = ($option == $defaultValue) ? 'selected="selected"' : '';

			$html .= '<option value="'.$option.'" '.$selected.'>'.$name.'</option>';
		}

		return $html;
	}

	public function renderServers($defaultValue = '')
	{
		$servers = $this->getServers();

		$list = array();

		if(count($servers) > 0)
		{
			foreach($servers as $index => $server)
			{
				$list[$server->server_id] = $server->server_name;
			}
		}

		$html = '';

		foreach($list as $option => $name)
		{
			$selected = ($option == $defaultValue) ? 'selected="selected"' : '';

			$html .= '<option value="'.$option.'" '.$selected.'>'.$name.'</option>';
		}

		return $html;
	}

	public function getServers()
	{ 
		
		$servers = $this->game->servers()->get();
		$tservers = array();

		if(count($servers) > 0)
		{
			foreach($servers as $server)
			{
				if($server->isFilter($this->user))
				{
					continue;
				}

				$tservers[] = $server;
			}
		}

		return $tservers;
	}
    
	public function addGold($server_id, $cash)
	{
		if($this->user instanceOf User)
		{
			// continue;
		}else{
			throw new Exception("Vui lòng đăng nhập", 700);
		}

		# Kiểm tra server
		$servers = $this->getServers();

		$list = array();

		if(count($servers) > 0)
		{
			foreach($servers as $index => $server)
			{
				$list[$server->server_id] = $server;
			}
		}

		if(!isset($list[$server_id]))
		{
			throw new Exception("Không tồn tại máy chủ này.", 700);
		}

		# Kiểm tra sv
		$this_server = $list[$server_id];

		if(($this_server->server_state != 'publish') && ($this_server->server_state != 'prioritized') && ($this_server->server_state != 'full'))
		{
			switch($this_server->server_state)
			{
				default:
					throw new Exception("Có lỗi xảy ra trong quá trình kiểm tra máy chủ.", 700);
				break;

				case 'waiting':
					throw new Exception("Máy chủ sẽ ra mắt ngày ".Pretty::fullTime($this_server->showPublic()), 700);
				break;

				case 'maintain':
					throw new Exception("Máy chủ đang bảo trì. Không thể chuyền tiền.", 700);
				break;

				case 'offline':
					throw new Exception("Máy chủ đang tắt. Không thể chuyền tiền.", 700);
				break;
			}
		}

		if(!$this_server->canTransfer())
		{
			throw new Exception("Hệ thống chưa cho phép vào chuyển tiền vào máy chủ.", 700);
		}

		# Random sleep
		$time_sleep = mt_rand(100, 1000) / 1000;

		sleep($time_sleep);

		# Kiểm tra xem có đủ cash hay ko
		$wallet = new \Trihtm\Wallet\WalletRepository($this->user->id);
		
		if($this->game->id == 21){
			if( $cash > ($wallet->getCash() * 1.1 ) )
			{
				throw new Exception("Bạn không đủ Cash để chuyển. Vui lòng chọn mệnh giá thấp hơn.", 700);
			}
		}
		else {
			if( $cash > $wallet->getCash() )
			{
				throw new Exception("Bạn không đủ Cash để chuyển. Vui lòng chọn mệnh giá thấp hơn.", 700);
			}
		}
		

		# Gọi service
		$ratio 	  = $this->game->ratio_cash / 100;
		$gold 	  = $cash * $ratio;
		
		if($this->game->gold_bonus_system == 1) // kick hoat system bonus
		{
			if($cash >= 5000 && $cash < 10000)
			{
				$gold = $cash * $ratio * 1.05;
			}elseif($cash >= 10000 && $cash < 20000){
				$gold = $cash * $ratio * 1.1;
			}elseif($cash >= 20000 && $cash < 50000){
				$gold = $cash * $ratio * 1.15;
			}elseif($cash >= 50000){
				$gold = $cash * $ratio * 1.2;
			}
		}
		
		// xy ly doi game Long MON
		if($this->game->id == 21){
			
			$gold = floor($cash/3);
			
			if($this->game->gold_bonus_system == 1) // kick hoat system bonus
			{
				if($cash >= 5000 && $cash < 10000)
				{
					$gold = floor($cash/3 * 1.05) ;
				}elseif($cash >= 10000 && $cash < 20000){
					$gold = floor($cash/3 * 1.1);
				}elseif($cash >= 20000 && $cash < 50000){
					$gold = floor($cash/3 * 1.15);
				}elseif($cash >= 50000){
					$gold = floor($cash/3 * 1.2);
				}
			}
			
			
		}		
		//Test doi voi Game Hu canh Van Linh
		if(($this->game->id == 14) && ($server_id == 999) ){
			$gold = floor($cash/3);
			if($this->game->gold_bonus_system == 1) // kick hoat system bonus
			{
				if($cash >= 5000 && $cash < 10000)
				{
					$gold = floor($cash/3 * 1.05) ;
				}elseif($cash >= 10000 && $cash < 20000){
					$gold = floor($cash/3 * 1.1);
				}elseif($cash >= 20000 && $cash < 50000){
					$gold = floor($cash/3 * 1.15);
				}elseif($cash >= 50000){
					$gold = floor($cash/3 * 1.2);
				}
			}
			
		}
		
		
		$url 	  = $this->game->api_transfer_cash;
		$trans_id = 'amo_'.implode('_', array(
			$this->game->id,
			$this->user->id,
			date('dmYHi')
		));

		$listTesters = Tester::renderOption();

		$tester = 0;
		if(in_array($this->user->username, $listTesters))
		{
			$trans_id = 'TEST_'.$trans_id;
			$tester = 1;
		}

		$param = array(
			'username' => $this->user->username,
			'user_id'  => $this->user->id,
			'identity' => $this->user->identity,
			'gameId'   => $this->game->id,
			'serverId' => $server_id,
			'orderId'  => $trans_id,
			'money'	   => $cash,
			'gold'	   => $gold
		);

		$pay = PayTransfer::create(array(
			'user_id' 		=> $this->user->id,
			'cash' 	  		=> $cash,
			'gold'			=> $gold,
			'game_id' 		=> $this->game->id,
			'server_id' 	=> $server_id,
			'status'		=> 0,
			'transaction'	=> $trans_id,
			'created_at' 	=> new Datetime
		));

		$pay->setResult('Đang chuyển tiền.');
		$return = false;
		try{
			if( ($this->game->id == 21) && ((date("Y-m-d H:i:s") <= "2015-07-14 23:59:59") ))
			{
				$wallet->subCash(($cash/1.1));
			}
			else {
				$wallet->subCash($cash);
			}
			

			$link = $url.'?'.http_build_query($param);
			$curl = new \Extend\Curl\Curl;
			
            $curl = $curl->config($link)->authorization()->get();
			//if($this->user->username == 'amoducpv'){dd($link);}
			//if($this->user->id == 6){dd($link );}
            $result = $curl->getResult();
			if(!$result)
			{
				throw new Exception("Không thực hiện được việc chuyển tiền. Vui lòng thử lại.", 700);
			}

			@preg_match("/RESULT:(.*?)@(.*?)/", $result, $matches);

			if(!isset($matches[1]))
			{
				throw new Exception("Không nhận được kết quả. Vui lòng thử lại.", 700);
			}

			switch($matches[1])
			{
				case '00': // thanh cong
					$pay->setResult("Thành công.");
					$pay->status = 1;
					$pay->save();
					$return = true;
				break;

				default:
				case '01':
				case '02':
				case '05':
					throw new Exception("Có lỗi xảy ra trong quá trình chuyển tiền. Mã lỗi: ".$matches[1], 700);
				break;

				case '03':
					throw new Exception("Không tồn tại nhân vật.", 500);
				break;

				case '04':
					throw new Exception("Mã giao dịch đã tồn tại. Vui lòng thử lại.", 501);
				break;
				
				case '204': // pendding
					$pay->setResult("pendding");
					$pay->status = 2;
					$pay->save();
					throw new Exception("Giao dịch đang xử lý, kiểm tra lại tiền trong Game sau 10 phút.", 502);
					break;
					
			}
		}catch(Exception $e){
			
			$message = ( $e->getCode() != 600 ) ? $e->getMessage() : 'Quá trình chuyển tiền vào game bị lỗi. Vui lòng liên hệ CSKH để được hỗ trợ.';
			
			//Chi co cong tien tu dong trong 2 truong hop: khong ton tai nhan vat va ma giao dich da ton tai
			if( ($e->getCode() == 500) || ($e->getCode() == 501) )
			{
				if( ($this->game->id == 21) && (date("Y-m-d H:i:s") <= "2015-07-14 23:59:59") )
				{
					$wallet->addCash(($cash/1.1));
				}
				else {
					$wallet->addCash($cash);
				}
				
				
			}	
	
			
			if($e->getCode() != 502)
			{
				$pay->setResult("Thất bại.");
			}

			if(!isset($matches[1])){
				$pay->setResultExtra($message."| Ko có mã lỗi ");
			}
			else {
				$pay->setResultExtra($message."| Ma loi: ".$matches[1]);
			}
			
			

			throw new Exception($message, $e->getCode());
		}
		
		//Nếu chuyển tiền thành công mà user đến từ viad thì gọi sang viad để thống kê quảng cáo
		if($return = true){
			
			if($this->user->user_from == 'viad'){
			
				//call via viad adnet for report
				$param_viad = array(
						'account'  => "viad",
						'password' => md5('fgameviad'),
						'userName' => $this->user->username,
						'gameName' => $this->game->game_name,
						'gameId'   => $this->game->id,
						'serverId' => $server_id,
						'cash'	   => $cash*100
				);
			
				$link_viad   = 'https://id.viad.vn/api-pay?';
				$curl_viad   = $curl->config($link_viad,$param_viad)->authorization()->get();
				$result_viad = $curl_viad->getResult();
				
				$arr_result_viad = json_decode($result_viad);
			
				//Luu ket qua goi API toi Viad
				DB::table('pay_transfer_viad')->insert(array(
					'user_id'     => $param['user_id'],
					'cash'        => $cash,
					'gold'        => $gold,
					'game_id'     => $param_viad['gameId'],
					'server_id'   => $param_viad['serverId'],
					'transaction' => $trans_id,
					'tester'      => $tester,
					'status'      => (($arr_result_viad->SUCCESS) ? 1:0),
					'message'     => $arr_result_viad->MESSAGE,
					'created_at'  => new Datetime
				));
			
			}
			return true;
		}
		
		
		
	}
}