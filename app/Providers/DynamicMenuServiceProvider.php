<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class DynamicMenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if (Schema::hasTable('menus')) {
            $dynamicMenu = Menu::getMenu();
        } else {
            $dynamicMenu = null;
        }

        View::share('dynamicMenu', $dynamicMenu);
    }
}
