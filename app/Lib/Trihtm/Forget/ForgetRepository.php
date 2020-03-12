<?php namespace Trihtm\Forget;

use User;
use Exception;
use App;
use UserForget;

class ForgetRepository
{
	protected $forgetContainer;

	public function __construct($mode)
	{
		switch($mode)
		{
			case 'email':
				$this->forgetContainer = new ForgetEmail;
			break;

			case 'question':
				$this->forgetContainer = new ForgetQuestion;
			break;

			default:
				App::abort(404);
			break;
		}
	}

	public function instance()
	{
		return $this->forgetContainer;
	}
}