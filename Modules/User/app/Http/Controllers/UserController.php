<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\Http\Requests\StoreUserRequest;
use Modules\User\Http\Requests\UpdateUserRequest;
use Modules\User\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display the index view.
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = $this->userService->getUserById($id);
        return view('user::edit', compact('user'));
    }

    /**
     * Store a newly created resource via web form.
     */
    public function store(StoreUserRequest $request)
    {
        $this->userService->createUser($request->validated());
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Update the specified resource via web form.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $this->userService->updateUser($id, $request->validated());
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }
}
