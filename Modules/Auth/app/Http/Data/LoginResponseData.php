<?php

namespace Modules\Auth\Http\Data;

use App\Models\User;
use Spatie\LaravelData\Data;

final class LoginResponseData extends Data
{
    public function __construct(
        public string $token,
        public User $user,
        public string $redirect,
    ) {
    }
}