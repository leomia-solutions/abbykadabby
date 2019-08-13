<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param \App\User $wantsToView
     * @param \App\User $userToView
     *
     * @return bool
     */
    public function view(User $wantsToView, User $userToView): bool
    {
        return ($wantsToView->isAdmin() || $wantsToView == $userToView);
    }
}
