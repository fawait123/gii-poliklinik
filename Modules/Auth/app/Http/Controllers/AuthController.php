<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Display the login form.
     */
    public function showLoginForm()
    {
        return view('auth::index');
    }
}
