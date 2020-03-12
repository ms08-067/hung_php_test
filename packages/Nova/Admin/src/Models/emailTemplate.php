<?php
namespace Nova\Admin\Models;
use Illuminate\Database\Eloquent\Model;

class emailTemplate extends Model {

	protected $guarded = array();
	public static $rules = array();

	protected $connection = 'mysql';
	protected $table 	  = 'email_template';
}

?>
