<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class NewPasswordController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['password' => 'required|min:8|confirmed']);

        $status = Password::reset($request->all(), function (User $user, $password) {
            $user->update(['password' => $password]);
        });

        throw_unless($status == Password::PASSWORD_RESET,
            ValidationException::withMessages(['password' => __($status)])
        );

        return Response::api(__($status));
    }
}
