<?php

namespace App\Providers;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        $this->app->bind(HomeController::class,function (){
            return new TestController();
        });
    }
}
