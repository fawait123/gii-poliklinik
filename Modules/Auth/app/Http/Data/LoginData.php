<?php

namespace Modules\Auth\Http\Data;

use Spatie\LaravelData\Data;

final class LoginData extends Data
{
    public function __construct(
        public string $email,
        public string $password,
        public bool $remember = false,
    ) {
    }
}