<?php

namespace Modules\User\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getAllPaginated($search = null, $perPage = 15);
    
    public function create(array $data);
    
    public function findById($id);
    
    public function update($id, array $data);
    
    public function delete($id);
}
