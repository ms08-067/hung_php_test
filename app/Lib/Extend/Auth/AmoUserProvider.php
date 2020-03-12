<?php 
namespace Extend\Auth;

use Illuminate\Auth\EloquentUserProvider;

class AmoUserProvider extends EloquentUserProvider
{
	protected $logic;

	function __construct($logic, $hash, $model)
	{
		parent::__construct($hash, $model);

		$this->logic = $logic;
	}

	// retrieveByID
	/**
	 * Retrieve a user by their unique identifier.
	 *
	 * @param  mixed  $identifier
	 * @return \Illuminate\Auth\UserInterface|null
	 */
	public function retrieveById($identifier)
	{
		$user = parent::retrieveById($identifier);

		$this->logic->throttle($user);

		return $user;
	}

	// retrieveByCredentials
	/**
	 * Retrieve a user by the given credentials.
	 *
	 * @param  array  $credentials
	 * @return \Illuminate\Auth\UserInterface|null
	 */
	public function retrieveByCredentials(array $credentials)
	{
		$user = parent::retrieveByCredentials($credentials);

		if($user)
		{
			$this->logic->throttle($user);
		}

		return $user;
	}
}