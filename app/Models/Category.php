<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use App\Models\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasUuids, HasSlug, SoftDeletes;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

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
