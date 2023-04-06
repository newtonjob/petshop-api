<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use App\Models\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasUuids, HasSlug;

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'metadata' => 'json'
    ];

    /**
     * Scope the query to filter results according to the current request.
     */
    public function scopeFilter(Builder $builder)
    {
        $builder->when(request('sortBy'), function (Builder $builder, $sortBy) {
            $builder->orderBy($sortBy, request()->boolean('desc') ? 'desc' : 'asc');
        });
    }
}
