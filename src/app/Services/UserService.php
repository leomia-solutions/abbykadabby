<?php

namespace App\Services;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @param string $id
     *
     * @return \App\User
     */
    public function findOrFail($id): User
    {
        $user = User::find($id);

        if (!$user) {
            abort(404);
        }

        return $user;
    }

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

        return $user;
    }
}
