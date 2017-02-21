<?php

namespace App\Models\Auth;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * Get selected role from database.
     *
     * @param String $role
     * @return mixed
     */
    public function getSelectedRole(String $role)
    {
        return Role::where('name', $role)->get()->first();
    }
}
