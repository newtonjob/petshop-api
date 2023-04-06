<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Models\User;
use Illuminate\Http\Response;

class AdminUserController extends Controller
{
    public function store(StoreAdminRequest $request)
    {
        return Response::api('Admin created successfully',
            User::create($request->validated())->append('token')
        );
    }
}
