<?php namespace Trihtm\Event\Folder;

use PayTransfer;
use DB;
use LogEvents;

class Transfer
{
	protected $rules;
	protected $user;
	protected $event;

	protected $start_time;
	protected $end_time;

	protected $validate = array();

	const NOT_READY = 0;
	const READY 	= 1;
	const USED 		= 2;

	public function importEvent($event)
	{
		$this->event = $event;
	}

	public function importRules($rules)
	{
		$this->rules = $rules;
	}

	public function importUser($user)
	{
		$this->user = $user;
	}

	public function importTime($start_time, $end_time)
	{
		$this->start_time = $start_time;
		$this->end_time   = $end_time;
	}

	/**
	 * Mode Tích lũy - OK
	 * Mode không tích lũy
	 */
	public function validateRules()
	{
		# parse rules
		$list_rules = array();

		foreach($this->rules as $rule)
		{
			// Ordered
			$namespace = $rule->params->namespace;

			$list_rules[$namespace][] = $rule;
		}

		# Parse log
		$logs = $this->getLog();

		# xử lý list gold
		$flag_add  = (isset($list_rules['tichluy'])) ? true : false;
		$limit 	   = (isset($list_rules['Xlandau'])) ? $list_rules['Xlandau'][0]->value : 0;
		$server_id = (isset($list_rules['servers'])) ? $list_rules['servers'][0]->value : 0;

		$own_gold = $this->getGold($server_id, $limit);

		if(!$flag_add)
		{
			$own_gold = max(0, $own_gold - $this->getGoldUsed());
		}

		$validate = array();

		if(isset($list_rules['gold']) && count($list_rules['gold']) > 0)
		{
			foreach($list_rules['gold'] as $index => $rule)
			{
				$rule_id   = $rule->id;
				$gold 	   = $rule->value;

				if(isset($list_rules['1ngayXlan']))
				{
					$count 			 = $list_rules['1ngayXlan'][0]->value;

					$canReceivedCode = $this->checkCountReceivedCode($rule_id, $count);

					if(!$canReceivedCode)
					{
						$validate[$rule_id]['state'] 	= self::USED;
						$validate[$rule_id]['message']  = '1 ngày chỉ có thể nhận code '. $count .' lần.';

						continue;
					}
				}

				if(isset($logs[$rule_id]['code']) && $logs[$rule_id]['code'] != '')
				{
					$validate[$rule_id]['state'] 	= self::USED;
					$validate[$rule_id]['message']  = 'Code của bạn là: '.$logs[$rule_id]['code'];

					continue;
				}

				if($own_gold >= $gold)
				{
					$validate[$rule_id]['state'] = self::READY;
				}else{
					$validate[$rule_id]['state'] 	= self::NOT_READY;
					$validate[$rule_id]['required'] = $gold;
					$validate[$rule_id]['own']	 	= $own_gold;
					$validate[$rule_id]['message']  = 'Bạn đã chuyển '.$own_gold.'/'.$gold.' Vàng.';
				}
			}
		}

		$this->validate = $validate;
	}

	public function validate()
	{
		return $this->validate;
	}

	private function getLog()
	{
		$list_logs = array();

		$logs = LogEvents::where('user_id', '=', $this->user->id)->where('event_id', '=', $this->event->id)->get();

		if(count($logs) == 0)
		{
			return $list_logs;
		}

		foreach($logs as $log)
		{
			$list_logs[$log->rule_id] = array(
				'code' 	 => $log->code,
				'extras' => $log->extras
			);
		}

		return $list_logs;
	}

	private function canReceivedCode($rule_id, $count)
	{
		$logs_count = LogEvents::where('user_id', '=', $this->user->id)
						 ->where('event_id', '=', $this->event->id)
						 ->where('rule_id', '=', $rule_id)
						 ->count();

		 return ($logs_count >= $count) ? false : true;
	}

	private function getGoldUsed()
	{
		$gold = LogEvents::where('user_id', '=', $this->user->id)
				 ->where('event_id', '=', $this->event->id)
				 ->sum('extras');

		 return $gold;
	}

	private function getGold($server_id = 0, $limit = 0)
	{
		$logs = PayTransfer::where('user_id', '=', $this->user->id)
								->where('game_id', '=', $this->event->game_id)
								->where('status', '=', 1)
								->where(DB::raw('UNIX_TIMESTAMP(created_at)'), '>=', $this->start_time)
								->where(DB::raw('UNIX_TIMESTAMP(created_at)'), '<=', $this->end_time)
								->orderBy('id', 'asc')
								->select('cash');

		if($server_id > 0)
		{
			$logs->where('server_id', '=', $server_id);
		}

		if($limit > 0)
		{
			$logs = $logs->take($limit);
		}

		$logs = $logs->get();

		$own_gold = 0;

		if(count($logs) > 0)
		{
			foreach($logs as $log)
			{
				$own_gold += $log->cash;
			}
		}

		$gold = (int) $own_gold;

		return $gold;
	}
}