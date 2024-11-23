<?php

namespace App\Providers;

use App\Application\Interfaces\UserServiceInterface;
use App\Application\Services\Implementations\UserService;
use App\Infrastructure\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Infrastructure\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind UserRepository interface to its Eloquent implementation
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

        // Bind UserService interface to its concrete implementation
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
