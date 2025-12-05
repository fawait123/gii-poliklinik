<?php

namespace Modules\User\Services;

use Illuminate\Support\Facades\Hash;
use Modules\User\Http\Data\CreateUserData;
use Modules\User\Http\Data\UpdateUserData;
use Modules\User\Http\Data\UserData;
use Modules\User\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers($request)
    {
        $search = $request->get('search');
        $perPage = $request->get('per_page', 15);

        $users = $this->userRepository->getAllPaginated($search, $perPage);

        // Transform paginated users to UserData
        $users->getCollection()->transform(function ($user) {
            return UserData::fromModel($user);
        });

        return $users;
    }

    public function createUser(CreateUserData $data): UserData
    {
        $userData = $data->toArray();
        $userData['password'] = Hash::make($userData['password']);
        unset($userData['password_confirmation']);

        $user = $this->userRepository->create($userData);
        return UserData::fromModel($user);
    }

    public function getUserById($id): UserData
    {
        $user = $this->userRepository->findById($id);
        return UserData::fromModel($user);
    }

    public function updateUser($id, UpdateUserData $data): UserData
    {
        $userData = $data->toArray();

        if (!empty($userData['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        } else {
            unset($userData['password']);
        }

        unset($userData['password_confirmation']);

        $user = $this->userRepository->update($id, $userData);
        return UserData::fromModel($user);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }
}
