<?php

namespace App\Providers;

use App\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->alias('request', Request::class);
        $this->app->bind(HttpRequest::class, Request::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
