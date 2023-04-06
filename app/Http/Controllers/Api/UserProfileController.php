<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserProfileController extends Controller
{
    public function show(Request $request)
    {
        return Response::api('User retrieved', $request->user());
    }

    public function store(StoreUserRequest $request)
    {
        return Response::api('User registered successfully',
            User::create($request->validated())
        );
    }

    public function update(UpdateUserRequest $request)
    {
        $this->authorize($request->user());

        $request->user()->update($request->validated());

        return Response::api('Updated successfully', $request->user());
    }

    public function destroy(Request $request)
    {
        $this->authorize($request->user());

        $request->user()->delete();

        return Response::api('User deleted successfully');
    }
}
