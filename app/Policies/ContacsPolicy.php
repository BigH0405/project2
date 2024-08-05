<?php

namespace App\Policies;

use App\Models\admin\Contacts;
use App\Models\admin\Users;
use Illuminate\Auth\Access\Response;

class ContacsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Users $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Users $user)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Users $user)
    {
        $roleJson = $user->Group->permissions;
        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
            return isRole($roleArr, 'contacts','add');
        }
            return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Users $user)
    {
        $roleJson = $user->Group->permissions;
        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
            return isRole($roleArr, 'contacts','edit');
        }
            return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Users $user)
    {
        $roleJson = $user->Group->permissions;
        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
            return isRole($roleArr, 'contacts','delete');
        }
            return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Users $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Users $user)
    {
        //
    }
}
