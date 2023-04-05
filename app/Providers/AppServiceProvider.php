<?php

namespace App\Providers;

use Illuminate\Http\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerApiResponseMacro();
    }

    /**
     * Creates a Response macro for API json responses having the standard format;
     *
     * {"status": true, "title": "Some title", "message": "Successful", "data": [a, b, c]}
     */
    public function registerApiResponseMacro(): void
    {
        Response::macro('api', function (string $message, array $data = [], $status = 200, array $headers = []) {
            return response()->json(['message' => $message, 'data' => $data], $status, $headers);
        });
    }
}
