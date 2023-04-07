<?php

namespace App\Models;

use App\Models\Concerns\HasUuids;
use App\Models\Concerns\SortsByRequest;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasUuids, SortsByRequest;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title'];
}
