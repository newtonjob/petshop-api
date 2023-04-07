<?php

namespace App\Policies;

use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderStatusPolicy
{
    /**
     * Perform pre-authorization checks.
     */
    public function before(User $user, string $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OrderStatus $orderStatus): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OrderStatus $orderStatus): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OrderStatus $orderStatus): bool
    {
        //
    }
}
