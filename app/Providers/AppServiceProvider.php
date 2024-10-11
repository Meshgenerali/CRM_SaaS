<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Http\Models\User;
use App\Models\Business;
use App\Models\Plan;

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
        Gate::before(function ($user, $permission) {
          $business = Business::find(session('businessId'));

            if($business->plan->permissions->flatten()->pluck('name')->unique()->contains($permission)) {
                return $user->permissions()->contains($permission);

            } else {
                //abort('403', 'This Action is Unauthorized');
                return false;
            }

            return $user->permissions()->contains($permission);
        });
    }
}
