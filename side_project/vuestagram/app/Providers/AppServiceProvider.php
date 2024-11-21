<?php

namespace App\Providers;

use App\Utils\MyEncrypt;
use App\Utils\MyToken;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('MyEncrypt', function() {
            return new MyEncrypt();
        });
        $this->app->bind('MyToken', function() {
            return new MyToken();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
