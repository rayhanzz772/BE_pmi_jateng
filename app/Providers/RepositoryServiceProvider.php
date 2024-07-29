<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\OrderInterface;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(OrderInterface
        ::class,OrderInterface::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}