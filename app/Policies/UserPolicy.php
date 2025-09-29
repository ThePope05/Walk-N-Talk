<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Iedereen die is ingelogd mag profielen bekijken (read-only).
     */
    public function view(?\App\Models\User $auth, \App\Models\User $user): bool
{
    return (bool) $auth; // elke ingelogde user mag elk profiel bekijken
}
    public function update(\App\Models\User $auth, \App\Models\User $user): bool
{
    return $auth->is_admin || $auth->id === $user->id; // alleen admin/eigenaar mag bewerken
}
}
