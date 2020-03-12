<?php
namespace Nova\Admin\Models;
use Trihtm\Support\Model\Comment as Comment;
use Trihtm\Support\Model\Thread as Thread;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;
use App\Models\Permission;
use App\Models\PermissionEntry;
use App\Models\PermissionEntryContent;
use Nova\Admin\Models\SLogLogin;
use Nova\Admin\Models\SLogActivity;
use Request;

class Admin extends Authenticatable{

    protected $softDelete = true;

    protected $guarded = array();

    public static $rules = array();

    protected $connection  = 'mysql';
	protected $table       = 'admin';

    protected $appends     = array('permission', 'permission_content');

    public static $adminTitleClass = [
        'admin'     => 'bg-danger',
        'leader'    => 'bg-info',
        'operation' => 'bg-primary',
        'supporter' => '',
        'marketing' => '',
    ];

    public static $adminTitle = [
        'admin'     => 'Quản lý',
        'leader'    => 'Trưởng dự án',
        'operation' => 'Vận hành',
        'supporter' => 'CSKH',
        'marketing' => ''
    ];

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

	/**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function updateSessionID($null = false)
    {
        if($null)
        {
            $this->session_id = NULL;
        }else{
            $this->session_id = Session::getId();
        }

        $this->save();
    }

    public function updateLogLogin()
    {
    	SLogLogin::create(array(
    		'admin_id'    => $this->getAuthIdentifier(),
    		'ip'	     => Request::getClientIp(),
    		'created_at' => date("Y-m-d H:i:s")
		));

        $this->last_login_at = date("Y-m-d H:i:s");
        $this->save();
    }

    public function updateLogActivity($user_id, $content, $type = 0)
    {
    	\Nova\Admin\Models\SLogActivity::create(array(
    		'admin_id'    => $this->getAuthIdentifier(),
            'user_id'     => $user_id,
    		'content'     => $content,
    		'ip'	      => Request::getClientIp(),
            'type'        => $type,
    		'created_at'  => date("Y-m-d H:i:s")
		));
    }

    public function getRolesAttribute($roles)
    {
        if($roles == NULL || !$roles)
        {
            return array();
        }

        $roles = json_decode($roles, true);

        return $roles;
    }

    public function checkRole($did, $tid)
    {
        if($this->type == 'admin')
        {
            return true;
        }

        if(isset($this->roles[$did][$tid]) && $this->roles[$did][$tid])
        {
            return true;
        }else{
            return false;
        }
    }

    public function checkRoleDepartment($did)
    {
        if($this->type == 'admin')
        {
            return true;
        }

        if(isset($this->roles[$did]) && $this->roles[$did])
        {
            return true;
        }

        return false;
    }

    public function isAdmin()
    {
        return ($this->type == 'admin') ? true : false;
    }

    public function isLeader()
    {
        if($this->isAdmin()) return true;

        return ($this->type == 'leader') ? true : false;
    }

    public function isOperation()
    {
        if($this->isAdmin()) return true;

        return ($this->type == 'operation') ? true : false;
    }
	
    public function isMarketing()
    {
    	if($this->isAdmin()) return true;
    
    	return ($this->type == 'marketing') ? true : false;
    }
    
    public function isSupporter()
    {
        if($this->isAdmin()) return true;

        return ($this->type == 'supporter') ? true : false;
    }

    public function resetCacheAuthorization()
    {
        $key = 'Object-based-authorization-'.$this->id;

        return Cache::forget($key);
    }

    public function permissions()
    {
        $key = 'Object-based-authorization-'.$this->id;

        if(Cache::has($key))
        {
            return Cache::get($key);
        }

        # Lấy về
        $default          = Permission::getPermissionDefault();
        $own              = PermissionEntry::getPermissionByUserID($this->id);

        foreach($default as $perm_id => $perm)
        {
            $next         = true;
            $perm_id_temp = $perm_id;

            do{
                $depend = $default[$perm_id_temp]['depend'];

                if(isset($own[$depend]))
                {
                    if($own[$depend]['value'] == 'allow')
                    {
                        if(isset($defaut[$depend]['depend']))
                        {
                            $perm_id_temp  = $defaut[$depend]['depend'];
                        }else{
                            $own[$perm_id] = (isset($own[$perm_id])) ? $own[$perm_id] : $perm;

                            break;
                        }
                    }else{
                        $perm['value']     = 'deny';
                        $perm['value_int'] = 0;

                        $own[$perm_id] = $perm;

                        break;
                    }
                }else{
                    $own[$perm_id] = (isset($own[$perm_id])) ? $own[$perm_id] : $perm;

                    break;
                }
            }while($next);
        }

        foreach($own as $perm_id => $perm)
        {
            $own[trim($perm_id)] = $perm['value'];
        }

        Cache::put($key, $own, 30);

        return $own;
    }

    public function resetPermissionType()
    {
        $key = 'Object-based-authorization-object-'.$this->id;

        Cache::forget($key);
    }

    public function permissionsType()
    {
        $key = 'Object-based-authorization-object-'.$this->id;

        if(Cache::has($key))
        {
            return Cache::get($key);
        }

        $all_perms = PermissionEntryContent::where('user_id', '=', $this->id)->get();

        $own = [];

        if(count($all_perms) == 0)
        {
            return $own;
        }

        $default          = Permission::getPermissionDefault();

        # Parse
        foreach($all_perms as $perm)
        {
            $own[$perm->content_type][$perm->content_id][$perm->permission_id] = $perm->permission_value;
        }

        # Set default
        foreach($all_perms as $perm)
        {
            foreach($default as $perm_id => $temp)
            {
                if(isset($own[$perm->content_type][$perm->content_id][$perm_id])) continue;

                $own[$perm->content_type][$perm->content_id][$perm_id] = $this->permission[$perm_id];
            }
        }

        foreach($own as $content_type => $temp)
        {
            foreach($temp as $content_id => $temp2)
            {
                foreach($temp2 as $perm_id => $permission_value)
                {
                    // depend on root level
                    $next         = true;
                    $perm_id_temp = $perm_id;

                    do{
                        $depend = $default[$perm_id_temp]['depend'];

                        if(isset($own[$content_type][$content_id][$depend]))
                        {
                            if($own[$content_type][$content_id][$depend] == 'allow')
                            {
                                if(isset($defaut[$depend]['depend']))
                                {
                                    $perm_id_temp  = $defaut[$depend]['depend'];
                                }else{
                                    $own[$content_type][$content_id][$perm_id] = (isset($own[$content_type][$content_id][$perm_id])) ? $own[$content_type][$content_id][$perm_id] : $perm;

                                    break;
                                }
                            }else{
                                $own[$content_type][$content_id][$perm_id] = 'deny';

                                break;
                            }
                        }else{
                            $own[$content_type][$content_id][$perm_id] = (isset($own[$content_type][$content_id][$perm_id])) ? $own[$content_type][$content_id][$perm_id] : $perm;

                            break;
                        }
                    }while($next);
                }
            }
        }

        Cache::put($key, $own, 30);

        return $own;
    }

    public function permType($perm, $type, $value, $throw = true)
    {
        if($this->isAdmin())
        {
            return true;
        }

        try{
            if(!isset($this->permission[$perm]))
            {
                throw new Exception("Load permission failed", 600);
            }

            $perm_value = $this->permission[$perm];

            switch($perm_value)
            {
                default:
                case 'deny':
                    throw new Exception("Deny", 600);
                break;

                case 'unset':
                    if(isset($this->permission_content[$type][$value][$perm]) && $this->permission_content[$type][$value][$perm] == 'allow')
                    {
                        return true;
                    }else{
                        throw new Exception("No permission", 600);
                    }
                break;

                case 'allow':
                    # Allow all except deny
                    if(!isset($this->permission_content[$type][$value][$perm]) || $this->permission_content[$type][$value][$perm] == 'deny')
                    {
                        throw new Exception("No permission", 600);
                    }else{
                        return true;
                    }
                break;
            }
        }catch(Exception $e){
            if($e->getCode() != 600)
            {
                throw $e;
            }
        }

        if($throw)
        {
            throw new Trihtm\Exceptions\NotAuthorizedPermission;
        }else{
            return false;
        }
    }

    /**
     * Kiểm tra Permission
     * @param  [type] $perm [description]
     * @return [type]       [description]
     */
    public function perm($perm, $throw = true)
    {
        if($this->isAdmin())
        {
            return true;
        }

        if(isset($this->permission[$perm]) && $this->permission[$perm] == 'allow')
        {
            return true;
        }

        if($throw)
        {
            throw new Trihtm\Exceptions\NotAuthorizedPermission;
        }else{
            return false;
        }
    }

    public function getPermissionAttribute()
    {
        return $this->permissions();
    }

    public function getPermissionContentAttribute()
    {
        return $this->permissionsType();
    }
}
