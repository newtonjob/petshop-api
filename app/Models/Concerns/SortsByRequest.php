<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait SortsByRequest
{
    public static function bootSortsByRequest(): void
    {
        static::addGlobalScope(function (Builder $builder) {
            $builder->when(request('sortBy'), function (Builder $builder, $sortBy) {
                $builder->orderBy($sortBy, request()->boolean('desc') ? 'desc' : 'asc');
            });
        });
    }
}
