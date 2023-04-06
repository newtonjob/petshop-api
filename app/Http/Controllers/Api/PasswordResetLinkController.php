<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;

class PasswordResetLinkController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['email' => 'exists:users']);

        abort_if(($user = User::firstWhere($request->only('email')))->isAdmin(), 403,
            'Cannot reset password for admin account.'
        );

        return Response::api('Token generated', [
            'reset_token' => Password::createToken($user)
        ]);
    }
}
