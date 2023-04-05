<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JwtToken extends Model
{
    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'permissions'  => 'json',
        'restrictions' => 'json',
        'last_used_at' => 'datetime',
        'expires_at'   => 'datetime',
        'refreshed_at' => 'datetime',
    ];

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

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
