<?php

namespace Modules\User\Http\Data;

use Spatie\LaravelData\Data;

final class CreateUserData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?string $password_confirmation = null,
    ) {
    }
}
