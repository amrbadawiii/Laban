<?php

namespace App\Providers;

use App\Application\Interfaces\AuthServiceInterface;
use App\Application\Interfaces\ICompanyService;
use App\Application\Interfaces\ICustomerService;
use App\Application\Interfaces\ISupplierService;
use App\Application\Interfaces\IWarehouseService;
use App\Application\Interfaces\UserServiceInterface;
use App\Application\Services\AuthService;
use App\Application\Services\CompanyService;
use App\Application\Services\CustomerService;
use App\Application\Services\SupplierService;
use App\Application\Services\UserService;
use App\Application\Services\WarehouseService;
use App\Infrastructure\Interfaces\ICompanyRepository;
use App\Infrastructure\Interfaces\ICustomerRepository;
use App\Infrastructure\Interfaces\ISupplierRepository;
use App\Infrastructure\Interfaces\IWarehouseRepository;
use App\Infrastructure\Interfaces\UserRepositoryInterface;
use App\Infrastructure\Interfaces\WarehouseRepositoryInterface;
use App\Infrastructure\Repositories\CompanyRepository;
use App\Infrastructure\Repositories\CustomerRepository;
use App\Infrastructure\Repositories\SupplierRepository;
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
        $this->app->bind(IWarehouseRepository::class, WarehouseRepository::class);
        $this->app->bind(ICompanyRepository::class, CompanyRepository::class);
        $this->app->bind(ICustomerRepository::class, CustomerRepository::class);
        $this->app->bind(ISupplierRepository::class, SupplierRepository::class);

        // Service Bindings
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(IWarehouseService::class, WarehouseService::class);
        $this->app->bind(ICompanyService::class, CompanyService::class);
        $this->app->bind(ICustomerService::class, CustomerService::class);
        $this->app->bind(ISupplierService::class, SupplierService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
