<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use App\Models\Concerns\HasUuids;
use App\Models\Concerns\SortsByRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasUuids, HasSlug, SortsByRequest;

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'metadata' => 'json'
    ];
}
