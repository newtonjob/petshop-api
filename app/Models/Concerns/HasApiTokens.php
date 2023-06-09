<?php

namespace App\Models\Concerns;

use App\Models\JwtToken;
use App\Support\Jwt;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasApiTokens
{
    /**
     * Get the access tokens that belong to model.
     */
    public function tokens(): HasMany
    {
        return $this->hasMany(JwtToken::class);
    }

    /**
     * Create a new personal access token for the user.
     */
    public function createToken(string $name = 'Personal', array $permissions = ['*'], DateTimeInterface $expiresAt = null): string
    {
        return tap(
            Jwt::encode(array_filter([
                'sub' => $name,
                'uid' => $this->id,
                'exp' => $expiresAt?->getTimestamp()
            ])),
            function ($token) use ($name, $permissions, $expiresAt) {
                $this->tokens()->create([
                    'token_title' => $name,
                    'unique_id'   => hash('sha256', $token),
                    'permissions' => $permissions,
                    'expires_at'  => $expiresAt,
                ]);
            }
        );
    }
}
