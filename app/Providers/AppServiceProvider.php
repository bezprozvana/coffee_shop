<?php

namespace App\Providers;
use App\Models\Address;
use App\Policies\AddressPolicy;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    // app/Providers/AuthServiceProvider.php
protected $policies = [
    Address::class => AddressPolicy::class,
];
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
        //
    }
}
