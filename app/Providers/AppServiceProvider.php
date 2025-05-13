<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Livewire\Livewire;
use App\Livewire\Layout\DynamicNavigation;
use App\Livewire\SubMenuButtons;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Livewire::component('layout.dynamic-navigation', DynamicNavigation::class);
        Livewire::component('sub-menu-buttons', SubMenuButtons::class);
    }
}