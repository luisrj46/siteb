<?php

namespace App\Providers;

use App\Core\KTBootstrap;
use Database\Seeders\Roles\RolesSeeder;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;

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
        LogViewer::auth(function ($request) {
            return $request->user()->hasRole(RolesSeeder::ROOT) ? true : false;

        });

        // Update defaultStringLength
        Builder::defaultStringLength(191);

        KTBootstrap::init();
        
        view()->composer('*', function($view) {
            $view->with('authUser', Auth::user());
        });
    }
}
