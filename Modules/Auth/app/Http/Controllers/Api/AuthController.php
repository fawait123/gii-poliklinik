<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Data\ResponseData;
use Illuminate\Http\Request;
use Modules\Auth\Http\Data\LoginData;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Handle login request.
     */
    public function login(LoginRequest $request)
    {
        $data = LoginData::from($request->validated());
        $result = $this->authService->login($data);

        // Return token and user info
        return (new ResponseData(true, 'Login successful', $result->toArray()))->json();
    }

    public function logout(Request $request)
    {
        // Revoke the token used for this request
        if ($request->user()) {
            $request->user()->token()->revoke();
        }
        return (new ResponseData(true, 'Logout successful'))->json();
    }

    /**
     * Get authenticated user.
     */
    public function user(Request $request)
    {
        return (new ResponseData(true, 'Authenticate user', $request->user()))->json();
    }
}
