<?php

namespace App\Providers;

use App\Application\Interfaces\AuthServiceInterface;
use App\Application\Interfaces\UserServiceInterface;
use App\Application\Services\AuthService;
use App\Application\Services\UserService;
use App\Infrastructure\Interfaces\UserRepositoryInterface;
use App\Infrastructure\Interfaces\WarehouseRepositoryInterface;
use App\Infrastructure\Repositories\WarehouseRepository;
use Illuminate\Support\ServiceProvider;
use App\Infrastructure\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repository Bindings
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(WarehouseRepositoryInterface::class, WarehouseRepository::class);

        // Service Bindings
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
