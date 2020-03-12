<?php 
namespace Trihtm\Support\Model;
use Illuminate\Database\Eloquent\Model;
class Department extends Model{

	protected $guarded = array();

	public static $rules = array();

	public $timestamps 	  = false;
	protected $table 	  = 'departments';
	protected $connection = 'support';

	public function tasks()
	{
		return $this->belongsToMany('Trihtm\Support\Model\Task')->withPivot('sort')->orderBy('sort', 'asc');
	}

    public function games()
    {
        return $this->belongsTo('\App\Models\Game', 'game');
    }
}