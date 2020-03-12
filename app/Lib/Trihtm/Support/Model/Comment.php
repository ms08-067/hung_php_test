<?php namespace Trihtm\Support\Model;

use Datetime;

class Comment extends \Eloquent{

	protected $guarded = array();

	public static $rules = array();

	public $timestamps 	  = false;
	protected $table 	  = 'comments';
	protected $connection = 'support';

	public function getDatecreateAttribute($datecreate)
	{
		$date = new Datetime($datecreate);

		return $date->getTimestamp();
	}

	public function parseImagesUrl()
	{
		$images_url = @explode('@@@@@', $this->url);

		if(count($images_url) == 0)
		{
			return array();
		}

		return $images_url;
	}

	public function admin()
	{
		return $this->belongsTo('\App\Models\Admin', 'owner_name', 'username');
	}
}