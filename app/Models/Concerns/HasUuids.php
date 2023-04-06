<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Concerns\HasUuids as EloquentHasUuids;

trait HasUuids
{
    use EloquentHasUuids;

    public function initializeHasUuids()
    {
        $this->usesUniqueIds = true;
        $this->hidden[]      = 'id';
    }

    /**
     * Get the columns that should receive a unique identifier.
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
