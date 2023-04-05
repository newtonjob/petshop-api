<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function store(Request $request)
    {
        throw_unless(
            Auth::attemptWhen($request->only(['email', 'password']), fn ($user) => $user->isAdmin()),
            ValidationException::withMessages(['email' => __('auth.failed')])
        );

        return Response::api('Welcome back.', [
            'token' => Auth::user()->createToken()
        ]);
    }

    public function destroy(Request $request)
    {
        $request->user()->tokens()->delete();

        return Response::api('Logged out successfully.');
    }
}
