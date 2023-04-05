<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\JwtToken;
use App\Support\Jwt;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Auth::viaRequest('api', fn (Request $request) => rescue(function () use ($request) {
            $uid = Jwt::uid($token = $request->bearerToken());

            if (! $jwtToken = JwtToken::findToken($token)) {
                return null;
            }

            if ($jwtToken->user_id != $uid) {
                return null;
            }

            return $jwtToken->user;
        }));
    }
}
