<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JwtToken extends Model
{
    /**
     * Find the token instance matching the given token.
     */
    public static function findToken(string $token): ?static
    {
        return static::where('unique_id', hash('sha256', $token))->first();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
