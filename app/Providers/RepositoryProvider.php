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
            return $app->get(RepositoryRestRestUser::class);
        });
        $this->app->bind(InterfaceRepositoryRestApp::class, function ($app) {
            return $app->get(RepositoryRestRestApp::class);
        });
        $this->app->bind(InterfaceRepositoryPortal::class, function ($app) {
            return $app->get(RepositoryPortal::class);
        });
        $this->app->bind(InterfaceRepositoryCall::class, function ($app) {
            return $app->get(RepositoryCall::class);
        });
        $this->app->bind(InterfaceRepositoryRestCall::class, function ($app) {
            return $app->get(RepositoryRestCall::class);
        });
        $this->app->bind(InterfaceRepositorySetting::class, function ($app) {
            return $app->get(RepositorySetting::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
