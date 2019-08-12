<?php

namespace App\Services;

use App\User;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Authenticates a user or aborts with a 404
     * 
     * @param string $email
     * @param string $password
     * 
     * @return \App\User
     */
    public function authenticate($email, $password): User
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            abort(404);
        }

        Auth::login($user);

        return $user;
    }
}
