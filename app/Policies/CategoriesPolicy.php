<?php

namespace App\Policies;

use App\Models\User;
use App\Models\category;
use Illuminate\Auth\Access\Response;


class CategoriesPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

       function update(User $user,category $category): bool
    {
        return $user->can('is_admin');
       
    }
}
