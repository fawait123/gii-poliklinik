<?php

namespace Modules\User\Repositories;

use App\Models\User;
use Modules\User\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAllPaginated($search = null, $perPage = 15)
    {
        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        return $query->latest()->paginate($perPage);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->findById($id);
        return $user->delete();
    }
}
