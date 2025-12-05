<?php

namespace Modules\User\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Data\ResponseData;
use Illuminate\Http\Request;
use Modules\User\Http\Data\CreateUserData;
use Modules\User\Http\Data\UpdateUserData;
use Modules\User\Http\Requests\StoreUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Services\UserService;
use Modules\User\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = $this->userService->getUsers($request);
        return (new ResponseData(true, 'Users retrieved successfully', $users))->json();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = CreateUserData::from($request->validated());
        $user = $this->userService->createUser($data);

        return (new ResponseData(true, 'User created successfully', $user))->json(201);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return (new ResponseData(true, 'User retrieved successfully', $user))->json();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = UpdateUserData::from($request->validated());
        $user = $this->userService->updateUser($id, $data);

        return (new ResponseData(true, 'User updated successfully', $user))->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->userService->deleteUser($id);

        return (new ResponseData(true, 'User deleted successfully'))->json();
    }

    /**
     * Export users to Excel.
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
