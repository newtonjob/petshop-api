<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Concerns\HasApiTokens;
use App\Models\Concerns\HasUuids;
use App\Models\Concerns\SortsByRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, SoftDeletes, SortsByRequest;

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function password(): Attribute
    {
        return Attribute::set(fn ($value) => bcrypt($value));
    }

    public function token(): Attribute
    {
        return Attribute::get(fn () => $this->createToken());
    }

    /**
     * Determine if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->is_admin;
    }

    /**
     * Scope the query to filter results according to the current request.
     */
    public function scopeFilter(Builder $builder)
    {
        $builder->when(request('first_name'))->whereFirstName(request('first_name'))
            ->when(request('email'))->whereEmail(request('email'))
            ->when(request('phone'))->wherePhone(request('phone'))
            ->when(request('is_marketing'))->whereIsMarketing(request()->boolean('is_marketing'));
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
