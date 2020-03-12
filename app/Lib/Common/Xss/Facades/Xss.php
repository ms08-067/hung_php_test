<?php namespace Trihtm\Xss\Facades;

use Illuminate\Support\Facades\Facade;

class Xss extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'xss'; }

}