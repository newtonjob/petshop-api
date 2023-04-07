<?php

namespace App\Http\Middleware;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class ConvertJsonStringsToArray extends TransformsRequest
{
    /**
     * Transform the given value.
     */
    protected function transform($key, $value)
    {
        return str($value)->startsWith('{') && str($value)->isJson()
            ? Json::decode($value)
            : $value;
    }
}
