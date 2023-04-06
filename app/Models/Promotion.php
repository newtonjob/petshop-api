<?php

namespace App\Models;

use App\Models\Concerns\HasUuids;
use App\Models\Concerns\SortsByRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Promotion extends Model
{
    use HasFactory, HasUuids, SortsByRequest;

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
        $builder->when(request('valid'))->where(function ($builder) {
            $now        = now()->toDateString();
            $expression = DB::raw("'$now'");

            $builder->when(request()->boolean('valid'),
                fn (Builder $builder) => $builder->whereBetweenColumns(
                     $expression, ['metadata->valid_from', 'metadata->valid_to']
                ),
                fn (Builder $builder) => $builder->whereNotBetweenColumns(
                    $expression, ['metadata->valid_from', 'metadata->valid_to']
                ),
            );
        });
    }
}
