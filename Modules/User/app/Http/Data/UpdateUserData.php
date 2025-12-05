<?php

namespace Modules\User\Http\Data;

use Spatie\LaravelData\Data;

final class UpdateUserData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $password = null,
        public ?string $password_confirmation = null,
    ) {
    }
}
