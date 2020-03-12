<?php namespace Trihtm\SSO;

use Request;
use Exception;
use Redirect;
use Input;
use DB;
use Auth;

use Response;
use Session;
use User;
use Config;
use Datetime;

use AuthorizationSSO;
use AuthorizationRedirect;

use Log;

class SSOMaster
{
	protected static $instance;

	public static function getInstance()
	{
		if(!isset(static::$instance))
		{
			static::$instance = new self;
		}

		return static::$instance;
	}

	protected $started = false;

	protected $user_id = 0;

	function __construct()
	{
		$this->list_public = AuthorizationSSO::parseOptionKeys();
	}

	protected function sessionStart()
	{
		if ($this->started) return;

        $this->started = true;

		if(isset($_COOKIE['SSOMasterSSID']) && preg_match('/^SSOMaster-(\w*+)-(\w*+)-([a-z0-9]*+)$/', $_COOKIE['SSOMasterSSID'], $matches))
		{
			$cid = $_COOKIE['SSOMasterSSID'];

			$public_key = $matches[1];
			$ss_token 	= $matches[2];

			if($cid != $this->generateSessionId($public_key, $ss_token))
			{
				throw new Exception("Error signal.", 600);
			}

			$ss = DB::table('sessions_sso')->where('public_key', '=', $public_key)->where('client_ss_id', '=', $cid)->get();

			if(count($ss) > 0)
			{
				$mid 	 	   = $ss[0]->master_ss_id;
				$this->user_id = $ss[0]->user_id;

				// try{
   					// DB::connection()->getPdo()->beginTransaction();

					// Delete SSO cũ của client này.
					DB::table('sessions_sso')->where('public_key', '=', $public_key)->where('master_ss_id', '=', $mid)->where('client_ss_id', '!=', $cid)->delete();

					// DB::connection()->getPdo()->commit();
		        // }catch (Exception $e) {
		        	// Log::error('SSO-Error-2: '.$e->getMessage());

		            // DB::connection()->getPdo()->rollBack();
		        // }
			}

			return;
		}
	}

	// Attach a user session to a broker session
	public function attach()
	{
		$this->sessionStart();

		if(!Request()->has('public_key'))
		{
			throw new Exception("No public_key.", 600);
		}

		if(!Request()->has('token'))
		{
			throw new Exception("No token", 600);
		}

		if(!Request()->has('checksum'))
		{
			throw new Exception("No checksum", 600);
		}

		if($this->generateAttachChecksum(Request()->input('public_key'), Request()->input('token')) != Request()->input('checksum'))
		{
			throw new Exception("Error checksum", 600);
		}

		$cid = $this->generateSessionId(Request()->input('public_key'), Request()->input('token'));
		$mid = Session::getId();

		// try{
   			// DB::connection()->getPdo()->beginTransaction();

			$num = DB::table('sessions_sso')->where('public_key', '=', Request()->input('public_key'))->where('client_ss_id', '=', $cid)->where('master_ss_id', '=', $mid)->count();

			if($num == 0)
			{
				$userid   = 0;
				$username = '';

				if(Auth::check())
				{
					$userid 	= Auth::user()->id;
					$username 	= Auth::user()->username;
				}

				if($userid > 0)
				{
					DB::table('sessions_sso')->where('user_id', '=', $userid)->where('public_key', '=', Request()->input('public_key'))->delete();

					DB::table('sessions_sso')->insert(array(
						'user_id' 	 	=> $userid,
						'public_key' 	=> Request()->input('public_key'),
						'client_ss_id' 	=> $cid,
						'master_ss_id' 	=> $mid,
						'updated_at'	=> new \Carbon\Carbon
					));

					DB::table('tracking_login')->insert(array(
						'user_id' 		=> $userid,
						'username' 		=> $username,
						'public_key'	=> Request()->input('public_key'),
						'created_at'	=> new \Carbon\Carbon
					));
				}
			}

			// DB::connection()->getPdo()->commit();
        // }catch (Exception $e) {
        	// Log::error('SSO-Error: '.$e->getMessage());

            // DB::connection()->getPdo()->rollBack();
        // }

		if(Request()->has('redirectURL'))
		{
			return Redirect::to(Request()->input('redirectURL'), 302);
		}

		// // Output an image specially for AJAX apps
        // header("Content-Type: image/png");
        // readfile("empty.png");
	}

	public function info()
	{
		$this->sessionStart();

		if($this->user_id > 0)
		{
			$user = User::findOrFail($this->user_id);

			return Response::json(array(
				'id' => $user->id,
				'username' => $user->username
			));
		}else{
			return Response::make("Not logged in", 401);
		}
	}

	protected function generateSessionId($public_key, $token)
	{
		if(!isset($this->list_public[$public_key]))
		{
			return null;
		}

		$params = array(
			'SSOMaster',
			$public_key,
			$token,
			md5('SSOClient'. $token . $this->list_public[$public_key])
		);

        return implode('-', $params);
	}

	/**
     * Generate session id from session token
     *
     * @return string
     */
    public function generateAttachChecksum($public_key, $token)
    {
        if (!isset($this->list_public[$public_key]))
    	{
    		return null;
		}

        return md5('SSOClientAttach' . $token . $this->list_public[$public_key]);
    }
}