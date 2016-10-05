<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Services\Test;

class TestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('TestService', function() {
            return new Test();
        });
        /*
        $this->app->bind('TestService',function() {
            return new Test;
        });
         */
    }
}
