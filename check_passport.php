<?php

require __DIR__ . '/vendor/autoload.php';

use Laravel\Passport\Passport;

echo "Passport class methods:\n";
print_r(get_class_methods(Passport::class));

if (method_exists(Passport::class, 'routes')) {
    echo "\nPassport::routes() EXISTS.\n";
} else {
    echo "\nPassport::routes() DOES NOT EXIST.\n";
}
