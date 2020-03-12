<?php namespace Trihtm\Support\Model;

use User;
use Datetime;

class Message extends \Eloquent{

	protected $guarded = array();

	public static $rules = array();

	public $timestamps 	  = true;
	protected $softDelets = true;

	protected $table 	  = 'messages';
	protected $connection = 'support';

	public function time()
	{
		$date = new Datetime($this->created_at);

		return $date->format('H:i d/m');
	}

	public static function sendMessage(User $user, $title, $content)
	{
		$user->inbox_unread += 1;
		$user->save();

		$message = static::create(array(
			'username' 		=> $user->username,
			'title'			=> $title,
			'content' 		=> $content,
			'created_at' 	=> new Datetime
		));

		return $message;
	}
}