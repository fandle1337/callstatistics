<?php

namespace App\Providers;
use App\Repository\Rest\RepositoryApp;
use App\Repository\Rest\RepositoryUser;
use Illuminate\Support\ServiceProvider;


class RepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Interface\InterfaceRepositoryUser::class, function ($app) {
            return $app->get(RepositoryUser::class);
        });
        $this->app->bind(\App\Interface\InterfaceRepositoryRestApp::class, function ($app) {
            return $app->get(RepositoryApp::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
