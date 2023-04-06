<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index(Request $request)
    {
        return User::whereIsAdmin(false)->filter()->paginate($request->limit);
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
