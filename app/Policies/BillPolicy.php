<?php

namespace App\Policies;

use App\Models\admin\Bill;
use App\Models\admin\Users;
use Illuminate\Auth\Access\Response;

class BillPolicy
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
            return isRole($roleArr, 'bills','add');
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
            return isRole($roleArr, 'bills','edit');
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
            return isRole($roleArr, 'bills','delete');
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
