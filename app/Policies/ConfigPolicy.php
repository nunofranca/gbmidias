<?php

namespace App\Policies;

use App\Models\Config;
use App\Models\Policy;
use App\Models\User;
use App\Observers\ConfigObserver;
use Illuminate\Auth\Access\Response;

class ConfigPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['SUPER', 'ADMIN']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Config $config): bool
    {
        return $user->hasRole(['SUPER', 'ADMIN']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['SUPER', 'ADMIN']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Config $config): bool
    {
        return $user->hasRole(['SUPER', 'ADMIN']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Config $config): bool
    {
        return $user->hasRole(['SUPER', 'ADMIN']);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Config $config): bool
    {
        return $user->hasRole(['SUPER', 'ADMIN']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Config $config): bool
    {
        return $user->hasRole(['SUPER', 'ADMIN']);
    }
}
