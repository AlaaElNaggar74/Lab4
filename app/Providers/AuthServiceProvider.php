<?php

namespace App\Providers;


use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

use App\Models\products;
use App\Policies\ProductsPolicy;

use App\Policies\CategoriesPolicy;
use App\Models\category;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        products::class=>ProductsPolicy::class,
        category::class=>CategoriesPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        
        Gate::define('is_admin',function (User $user){
            return $user->role === 'admin'  ;
        });
        Gate::define('is_user',function (User $user){
            return $user->role === 'user'  ;
        });
        // Gate::define('emp',function (User $user){
        //     return $user->role === 'emp'  ;
        // });
    }
}
