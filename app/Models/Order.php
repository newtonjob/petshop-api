<?php

namespace App\Models;

use App\Models\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;

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
