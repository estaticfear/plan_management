<?php

namespace IXOSoftware\PlanManagement;

use Illuminate\Support\ServiceProvider;

class PlanManagementServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Migrations
         */
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations')
        ]);

        /*
         * Routes
         */
        $this->loadRoutesFrom(__DIR__.'/../config/routes.php');
        $this->publishes([
            __DIR__.'/../config/routes.php' => base_path('routes/plan-management-routes.php'),
        ]);

        /*
         * View
         */
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-plan-management');
        $this->publishes([
           __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-plan-management')
        ]);

//        $this->publishes([
//            __DIR__.'/../resources/assets' => resource_path('assets/vendor/laravel-plan-management'),
//        ], 'vue-components');

        /*
         * Config
         */
        $this->mergeConfigFrom(__DIR__.'/../config/plan.php', 'plan');
        $this->publishes([
            __DIR__.'/../config/plan.php' => config_path('plan.php'),
        ]);

        /*
         * Assets
         */
        $this->publishes([
            __DIR__.'/../public/assets' => public_path('vendor/laravel-plan-management'),
        ], 'public');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }
}
