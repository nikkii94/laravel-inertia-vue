<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        return Auth::user()->email === 'teszt2@localhost';
    }

    /**
     * Determine whether the user can update models.
     *
     * @param User $user
     * @param User $model
     * @return Response|bool
     */
    public function edit(User $user, User $model)
    {
        return (bool)mt_rand(0, 1);
    }
}
