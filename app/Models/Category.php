<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use App\Models\Concerns\HasUuids;
use App\Models\Concerns\SortsByRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasUuids, HasSlug, SoftDeletes, SortsByRequest;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];
}
