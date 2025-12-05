<?php

namespace Modules\Auth\Repositories;

use App\Models\User;
use Modules\Auth\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * Query find by username
     *
     * @param string $username
     * @return User
     */
    public function findByUsername(string $username): ?User
    {
        return User::where('username', '=', $username)->first();
    }

    /**
     * Query find user by email
     *
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', '=', $email)->first();
    }

    /**
     * Logout the current user.
     *
     * @return void
     */
    public function logout(): void
    {
        Auth::logout();
    }

    /**
     * Get the authenticated user.
     *
     * @return \App\Models\User|null
     */
    public function user()
    {
        return Auth::user();
    }
}
