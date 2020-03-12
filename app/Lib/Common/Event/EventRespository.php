<?php namespace Trihtm\Event;

use User;
use Events;
use Exception;

class EventRespository
{
	protected $user;
	protected $event;

	protected $folderInstance;

	function __construct(User $user, Events $event)
	{
		$this->user 	= $user;
		$this->event 	= $event;

		try{
			$folderClass 		  = "\Trihtm\Event\Folder\\".$this->event->folder;
			$this->folderInstance = new $folderClass;
		}catch(Exception $e){
			throw new Exception("Không load được instance", 600);
		}

		$this->folderInstance->importEvent($this->event);
		$this->folderInstance->importUser($this->user);

		# Import rules
		if(!isset($this->event->paramsValue))
		{
			throw new Exception("Chưa tải được Rule", 600);
		}

		$rules = $this->event->paramsValue;

		$this->folderInstance->importRules($rules);
	}

	public function checkTime()
	{
		# Kiểm tra thời gian
		$started_at = strtotime($this->event->started_at);
		$ended_at 	= strtotime($this->event->ended_at);

		$now 		= $_SERVER['REQUEST_TIME'];

		if($now < $started_at)
		{
			throw new Exception("Sự kiện chưa diễn ra.", 600);
		}

		if($now > $ended_at)
		{
			throw new Exception("Sự kiện đã kết thúc.", 600);
		}

		$this->folderInstance->importTime($started_at, $ended_at);
	}

	public function validateDispatch()
	{

	}

	public function validateRule()
	{
		try{
			$this->folderInstance->validateRules();
		}catch(Exception $e){
			// throw $e;
			$message = ($e->getMessage() == 600) ? $e->getMessage() : 'Có lỗi xảy ra trong quá trình kiểm tra điều kiện.';

			throw new Exception($message, 600);
		}

		return $this->folderInstance->validate();
	}
}