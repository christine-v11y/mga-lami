<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
          View::composer('partials.sidebar', function ($view) {
        $menuItems = [
            [
                'label' => 'Dashboard',
                'route' => 'admin.dashboard',
                'icon' => 'bi bi-speedometer2',
                'children' => []
            ],
            [
                'label' => 'Users',
                'route' => 'admin.users.index',
                'icon' => 'bi bi-people',
                'children' => [
                    ['label' => 'All Users', 'route' => 'admin.users.index'],
                    ['label' => 'Add User', 'route' => 'admin.users.create'],
                ]
            ],
        ];

        $view->with('menuItems', $menuItems);
    });
    }
}
