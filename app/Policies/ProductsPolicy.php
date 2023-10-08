<?php

namespace App\Policies;

use App\Models\User;
use App\Models\products;
use Illuminate\Auth\Access\Response;


class ProductsPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //

    }

    public function destroy(User $user,products $products): bool
    {
        return ($user->id === $products->creator_id or $user->can('is_admin'))
        ? true
        : false;
    }

    public function update(User $user,products $products): bool
    {
        return ($user->id === $products->creator_id or $user->can('is_admin'))
        ? true
        : false;
    }
    // public function destroy(User $user,products $products): bool
    // {
    //     return $user->id === $products->creator_id
    //     ? Response::allow()
    //     : Response::deny('You do not own this post.');
    // }
    // public function update(User $user,products $products): bool
    // {
    //     return $user->id === $products->creator_id
    //     ? Response::allow()
    //     : Response::deny('You do not own this post.');
    // }
}
