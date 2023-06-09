<?php

namespace App\Models;

use App\Models\Concerns\HasUuids;
use App\Models\Concerns\SortsByRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory, HasUuids, SortsByRequest;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'details' => 'object'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
