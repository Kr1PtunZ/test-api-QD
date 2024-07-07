<?php

namespace App\Providers;

use App\Interfaces\TasksRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\TasksRepository;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TasksRepositoryInterface::class,TasksRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
