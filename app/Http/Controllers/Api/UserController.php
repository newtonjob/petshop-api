<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return User::whereIsAdmin(false)->filter()->paginate($request->limit);
    }

    public function store(StoreUserRequest $request)
    {
        return Response::api('User created successfully',
            User::create($request->validated())
        );
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());

        return Response::api('Updated successfully', $user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return Response::api('User deleted successfully');
    }
}
