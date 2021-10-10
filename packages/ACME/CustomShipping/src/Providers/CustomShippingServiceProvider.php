<?php

namespace ACME\CustomShipping\Providers;

use Illuminate\Support\ServiceProvider;

class CustomShippingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->loadMigrationsFrom(__DIR__.'/packages/ACME/Database/Migrations');
        $this->loadViewsFrom(base_path('packages\Webkul\Admin\src\Resources\views'), 'admin');
       //$this->loadRoutesFrom(base_path('packages\Webkul\Admin\src\Http\routes.php'));

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
       
    }
    
    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/carriers.php', 'carriers'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/admin_menu.php', 'menu.admin'
        );
    }
}
