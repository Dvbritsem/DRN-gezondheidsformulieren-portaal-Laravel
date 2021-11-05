<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    public function viewRoles(User $user)
    {
        if ($user->role == 'mod') {
            return true;
        }
        if ($user->role == 'admin') {
            return true;
        }
    }

    public function editRoles(User $user)
    {
        if ($user->role == 'admin') {
            return true;
        }
    }

    public function viewGezForm(User $user)
    {
        if ($user->role == 'mod') {
            return true;
        }
        if ($user->role == 'admin') {
            return true;
        }
    }

    public function editGezForm(User $user)
    {
        if ($user->role == 'admin') {
            return true;
        }
    }
}
