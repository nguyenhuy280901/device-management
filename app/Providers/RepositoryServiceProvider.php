<?php

namespace App\Providers;

use App\Repositories\Repository;
use App\Repositories\RepositoryInterface;
use App\Services\Service;
use App\Services\ServiceInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(RepositoryInterface::class, Repository::class);
        // $this->app->bind(ServiceInterface::class, Service::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
