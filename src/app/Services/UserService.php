<?php

namespace App\Services;

use App\Models\User;

class UserService
{
	public function login($email, $password)
	{
		$user = User::where('email', $email)
			->where('password', app('hash')->make($password))
			->first();

		return (bool) $user;
	}

	/**
	 * Creates a session key for a validated user
	 *
	 * @param \App\Models\User $user
	 *
	 * @return string
	 */
	protected function createSessionKey(User $user)
	{
		// TODO: fill in stub
	}
}