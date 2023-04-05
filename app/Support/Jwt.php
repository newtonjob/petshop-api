<?php

namespace App\Support;

use Firebase\JWT\JWT as BaseJwt;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\File;
use stdClass;

class Jwt
{
    /**
     * Encode the given payload.
     */
    public static function encode(array $payload): string
    {
        $payload = array_merge([
            'iss' => parse_url(config('app.url'), PHP_URL_HOST),
            'iat' => now()->unix(),
        ], $payload);

        return BaseJwt::encode($payload, File::get(storage_path('jwt-private.key')), 'RS256');
    }

    /**
     * Decode the given jwt token.
     */
    public static function decode(string $jwt): stdClass
    {
        return BaseJwt::decode($jwt, new Key(File::get(storage_path('jwt-public.key')), 'RS256'));
    }

    /**
     * Decode the given jwt token and get the uid claim;
     */
    public static function uid(string $jwt): int
    {
        return static::decode($jwt)->uid;
    }
}
