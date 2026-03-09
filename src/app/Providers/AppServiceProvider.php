<?php

namespace App\Providers;

use App\Models\Expenses;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();
       
        Gate::define('update', function (User $user, Expenses $expense) {
            return $user->id === $expense->user_id;
        });
        
        Gate::define('destroy', function (User $user, Expenses $expense) {
            return $user->id === $expense->user_id;
        });

    }
    
}
