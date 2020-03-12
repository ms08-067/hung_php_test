<?php 
namespace Trihtm\Support\Model;

use Illuminate\Database\Eloquent\Model;
use App\Models\User as User;
use Datetime;
use Pretty;
use Auth;

class Thread extends Model{

	protected $guarded = array();

	public static $rules = array();

	public $timestamps 	  = false;
	protected $table 	  = 'threads';
	protected $connection = 'support';

	public static function checkRest()
	{
		/**
		 *
		 	Thứ 2 - Thứ 7: 9h00 đến 21h30
			Chủ Nhật: 9h00 đến 17h00
		 */

		$now = with(new \Carbon\Carbon);
		$dayOfWeek = $now->dayOfWeek;

		$deltaCheck = $now->getTimestamp() - $now->startOfDay()->getTimestamp();

		if($dayOfWeek == \Carbon\Carbon::SUNDAY) // nếu là chủ nhật
		{
			$startTime = 9 * 3600;
			$endTime   = 17 * 3600;
		}else{
			$startTime = 9 * 3600;
			$endTime   = 21 * 3600 + 0.5 * 3600;
		}

		if($deltaCheck >= $startTime && $deltaCheck <= $endTime)
		{
			return false;
		}

		return true;
	}

	public function department()
	{
		return $this->belongsTo('Trihtm\Support\Model\Department', 'department_id');
	}

	public function task()
	{
		return $this->belongsTo('Trihtm\Support\Model\Task', 'task_id');
	}

	public function comments()
	{
		return $this->hasMany('Trihtm\Support\Model\Comment', 'thread_id')->where('comment_type', '=', 'normal')->orderBy('created_at', 'asc')->with('admin');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	public function admin()
	{
		return $this->belongsTo('Admin', 'admin_id');
	}

	public function scopeOfStatus($query, $status)
	{
		return $query->where('status', '=', $status);
	}

	public function scopeLive($query)
	{
		return $query->where('live', '=', 0)->whereNull('user_deleted_at');
	}

	public function scopeOfUser($query, $user_id)
	{
		return $query->where('user_id', '=', $user_id);
	}

	public function whoReplied()
	{
		$user_updated_at  = ($this->user_updated_at == NULL)  ? 0 : strtotime($this->user_updated_at);
		$admin_updated_at = ($this->admin_updated_at == NULL) ? 0 : strtotime($this->admin_updated_at);

		return $user_updated_at > $admin_updated_at ? 'user' : 'supporter';
	}

	public function preventRepiled()
	{
		$comments = $this->hasMany('Trihtm\Support\Model\Comment', 'thread_id')->orderBy('created_at', 'desc')->select('type')->take(2)->get();

		$count = 0;

		foreach($comments as $comment)
		{
			if($comment->type == 'user')
			{
				$count += 1;
			}
		}

		return ($count == 2) ? true : false;
	}

	public function showTimeAutoClosed()
	{
		$now 	= $_SERVER['REQUEST_TIME'];
		$end 	= strtotime($this->user_read_at) + 3600 * 3;

		$delta  = $end - $now;

		return Pretty::time_reserve($delta);
	}

	public function convertStatus()
	{
		if($this->status == 'done')
		{
			return 'done';
		}

		if($this->whoReplied() == 'supporter')
		{
			return 'running';
		}

		return 'waiting';
	}

	public function convertStatusToText()
	{
		if($this->status == 'done')
		{
			return 'Câu hỏi đã xử lý xong';
		}

		if($this->whoReplied() == 'supporter')
		{
			return 'Chờ CSKH trả lời';
		}

		return 'Câu hỏi đang xử lý.';
	}

	public function showAlert()
	{
		if($this->status != 'done' && $this->whoReplied() == 'supporter')
		{
			if(!isset($this->user_read_at) || !$this->user_read_at)
			{
				return false;
			}

			$check_time = strtotime($this->user_read_at) + 3600 * 3;

			if($_SERVER['REQUEST_TIME'] < $check_time)
			{
				return true;
			}
		}

		return false;
	}

	public function showRating()
	{
		if($this->status == 'done')
		{
			return true;
		}else{
			return false;
		}
	}

	public function showRated()
	{
		if($this->rating > 0)
		{
			return true;
		}

		return false;
	}

	public function convertRating()
	{
		switch($this->rating)
		{
			default:
				return 'Chưa đánh giá';
			break;

			case 1:
				return 'Trả lời chậm';
			break;

			case 2:
				return 'Trả lời sai';
			break;

			case 3:
				return 'Kém nhiệt tình';
			break;

			case 4:
				return 'Không bổ ích';
			break;

			case 5:
				return 'Thái độ không tốt';
			break;
		}
	}

	public function checkOwner()
	{
		if($this->user_id == Auth::user()->id)
		{
			return true;
		}

		return false;
	}

	public function close()
	{
		$this->closed_at 		= new Datetime;
		$this->closed_type 		= 'user';
		$this->closed_user_id 	= Auth::user()->id;
		$this->closed_reason 	= 'Người dùng đóng câu hỏi.';

		$this->status 			= 'done';
		$this->updated_at 		= new Datetime;
		$this->user_updated_at 	= new Datetime;
		$this->save();
	}

}