<?php

namespace Modules\Auth\Repositories\Contracts;

use App\Models\User;

interface AuthRepositoryInterface
{
    /**
     * Summary of findByUsername
     * @param string $username
     * @return User
     */
    public function findByUsername(string $username): ?User;

    /**
     * Summary of findByEmail
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): ?User;

    /**
     * Logout the current user.
     *
     * @return void
     */
    public function logout(): void;

    /**
     * Get the authenticated user.
     *
     * @return \App\Models\User|null
     */
    public function user();
}
