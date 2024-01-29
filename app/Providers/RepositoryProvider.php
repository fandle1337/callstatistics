<?php

namespace App\Providers;

use App\Interface\Rest\InterfaceRepositoryRestApp;
use App\Interface\Rest\InterfaceRepositoryRestCall;
use App\Interface\Rest\InterfaceRepositoryRestUser;
use App\Interface\Storage\InterfaceRepositorySetting;
use App\Repository\Rest\RepositoryRestCall;
use App\Repository\Rest\RepositoryRestRestApp;
use App\Repository\Rest\RepositoryRestRestUser;
use App\Interface\Storage\InterfaceRepositoryCall;
use App\Interface\Storage\InterfaceRepositoryPortal;
use App\Repository\Storage\RepositoryCall;
use App\Repository\Storage\RepositoryPortal;
use App\Repository\Storage\RepositorySetting;
use Illuminate\Support\ServiceProvider;


class RepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(InterfaceRepositoryRestUser::class, function ($app) {
            return $app->make(RepositoryRestRestUser::class);
        });
        $this->app->bind(InterfaceRepositoryRestApp::class, function ($app) {
            return $app->make(RepositoryRestRestApp::class);
        });
        $this->app->bind(InterfaceRepositoryPortal::class, function ($app) {
            return $app->make(RepositoryPortal::class);
        });
        $this->app->bind(InterfaceRepositoryCall::class, function ($app) {
            return $app->make(RepositoryCall::class);
        });
        $this->app->bind(InterfaceRepositoryRestCall::class, function ($app) {
            return $app->make(RepositoryRestCall::class);
        });
        $this->app->bind(InterfaceRepositorySetting::class, function ($app) {
            return $app->make(RepositorySetting::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
