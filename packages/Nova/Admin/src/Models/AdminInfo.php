<?php
namespace Nova\Admin\Models;
use Illuminate\Database\Eloquent\Model;

class AdminInfo extends Model {

	protected $guarded = array();
	public static $rules = array();

	protected $connection = 'mysql';
	protected $table 	  = 'admin_info';

	// public function channel(){
	// 	return $this->hasOne('\Nova\Admin\Models\ChannelVimeo', "channelId","channelId");
	// }
}
?>
