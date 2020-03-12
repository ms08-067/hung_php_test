<?php 
namespace Extend\Auth;

use Session;
use Pretty;

class AmoUserLogic
{
	protected $user;

	public function setUser($user)
	{
		$this->user = $user;

		return $this;
	}

	public function throttle($user)
	{
		$this->setUser($user);

		// Nếu Admin đang truy cập thì không cấm.
		if(!$this->checkAdminAccess())
		{
			$this->isBlocked();
			$this->isAccessed();
		}

		return $this;
	}

	protected function isBlocked()
	{
		if($this->user->isBlocked())
		{
			$date = $this->user->getBlockEndedTime();

			throw new \Extend\Auth\Exception\BlockedException("Tài khoản của bạn bị khóa tới ".Pretty::fullTime($date).". Vui lòng liên hệ bộ phận CSKH để được trợ giúp.");
		}

		return $this;
	}

	/**
	 * Supporter is logging.
	 * @return boolean [description]
	 */
	protected function isAccessed()
	{
		$password_temp = $this->user->getAuthPasswordTemp();

		if($password_temp)
		{
			throw new \Extend\Auth\Exception\ManagerAccessException;
		}

		return $this;
	}

	private function checkAdminAccess()
	{
		if(isset($_COOKIE['admin-amo-user']))
		{
			return true;
		}else{
			return false;
		}
	}
}