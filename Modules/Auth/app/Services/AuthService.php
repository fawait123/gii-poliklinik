<?php

namespace Modules\Auth\Services;

use Hash;
use Modules\Auth\Http\Data\LoginData;
use Modules\Auth\Http\Data\LoginResponseData;
use Modules\Auth\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Attempt to log in a user.
     *
     * @param array $credentials
     * @param bool $remember
     * @return LoginResponseData
     * @throws ValidationException
     */
    public function login(LoginData $data, bool $remember = false)
    {
        $user = $this->authRepository->findByEmail($data->email);

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        if (!Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        $token = $user->createToken(config('app.auth_token'));

        return new LoginResponseData(
            $token->accessToken,
            $user,
            '/dashboard'
        );
    }

    /**
     * Log out the current user.
     *
     * @return array
     */
    public function logout(): array
    {
        $this->authRepository->logout();

        return [
            'success' => true,
            'message' => 'Logout successful'
        ];
    }

    /**
     * Get the authenticated user.
     *
     * @return \App\Models\User|null
     */
    public function getAuthenticatedUser()
    {
        return $this->authRepository->user();
    }
}
