<?php namespace Trihtm\Support\Model;


class Task extends \Eloquent{

	protected $guarded = array();

	public static $rules = array();

	public $timestamps 	  = false;
	protected $table 	  = 'tasks';
	protected $connection = 'support';

}