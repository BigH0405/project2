<?php

namespace App\Policies;

use App\Models\admin\Products;
use App\Models\admin\Users;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Users $user)
    {
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Users $users, Products $products)
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
            return isRole($roleArr, 'products','add');
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
            return isRole($roleArr, 'products','edit');
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
            return isRole($roleArr, 'products','delete');
        }
            return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Users $users)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Users $users, Products $products)
    {
        //
    }
}
