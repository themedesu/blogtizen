<?php

namespace App\Providers;

use App\Models\Visitor as VisitorModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class VisitorServiceProvider extends ServiceProvider
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
        if (Schema::hasTable('visitors')) {
            $visitorToday = VisitorModel::today();
            $visitorYesterday = VisitorModel::yesterday();
            $visitorThisMonth = VisitorModel::thisMonth();
            $visitorThisYear = VisitorModel::thisYear();
            $visitorTotal = VisitorModel::total();
        } else {
            $visitorToday = null;
            $visitorYesterday = null;
            $visitorThisMonth = null;
            $visitorThisYear = null;
            $visitorTotal = null;
        }

        View::share(compact('visitorToday', 'visitorYesterday', 'visitorThisMonth', 'visitorThisYear', 'visitorTotal'));
    }
}
