<?php

namespace App\Providers;

use App\Repositories\EventRepository;
use App\Repositories\OcasionRepository;
use App\Repositories\TodoRepository;
use Illuminate\Support\ServiceProvider;
use Repositories\EventRepositoryInterface;
use Repositories\OcasionRepositoryInterface;
use Repositories\TodoRepositoryInterface;

class NewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TodoRepositoryInterface::class, TodoRepository::class);
        $this->app->bind(OcasionRepositoryInterface::class, OcasionRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
    }

}
