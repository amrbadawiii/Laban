<?php

namespace App\Providers;

use App\Application\Interfaces\AuthServiceInterface;
use App\Application\Interfaces\ICompanyService;
use App\Application\Interfaces\ICustomerService;
use App\Application\Interfaces\IInboundService;
use App\Application\Interfaces\IMeasurementUnitService;
use App\Application\Interfaces\IProductService;
use App\Application\Interfaces\IStockService;
use App\Application\Interfaces\ISupplierService;
use App\Application\Interfaces\IUserService;
use App\Application\Interfaces\IWarehouseService;
use App\Application\Interfaces\UserServiceInterface;
use App\Application\Services\StockService;
use App\Infrastructure\Interfaces\IUserRepository;
use App\Infrastructure\Repositories\StockRepository;
use App\Application\Services\AuthService;
use App\Application\Services\CompanyService;
use App\Application\Services\CustomerService;
use App\Application\Services\InboundService;
use App\Application\Services\MeasurementUnitService;
use App\Application\Services\ProductService;
use App\Application\Services\SupplierService;
use App\Application\Services\UserService;
use App\Application\Services\WarehouseService;
use App\Infrastructure\Interfaces\ICompanyRepository;
use App\Infrastructure\Interfaces\ICustomerRepository;
use App\Infrastructure\Interfaces\IInboundRepository;
use App\Infrastructure\Interfaces\IMeasurementUnitRepository;
use App\Infrastructure\Interfaces\IProductRepository;
use App\Infrastructure\Interfaces\IStockRepository;
use App\Infrastructure\Interfaces\ISupplierRepository;
use App\Infrastructure\Interfaces\IWarehouseRepository;
use App\Infrastructure\Interfaces\UserRepositoryInterface;
use App\Infrastructure\Repositories\CompanyRepository;
use App\Infrastructure\Repositories\CustomerRepository;
use App\Infrastructure\Repositories\InboundRepository;
use App\Infrastructure\Repositories\MeasurementUnitRepository;
use App\Infrastructure\Repositories\ProductRepository;
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
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IWarehouseRepository::class, WarehouseRepository::class);
        $this->app->bind(ICompanyRepository::class, CompanyRepository::class);
        $this->app->bind(ICustomerRepository::class, CustomerRepository::class);
        $this->app->bind(ISupplierRepository::class, SupplierRepository::class);
        $this->app->bind(IMeasurementUnitRepository::class, MeasurementUnitRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IInboundRepository::class, InboundRepository::class);
        $this->app->bind(IStockRepository::class, StockRepository::class);

        // Service Bindings
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(IWarehouseService::class, WarehouseService::class);
        $this->app->bind(ICompanyService::class, CompanyService::class);
        $this->app->bind(ICustomerService::class, CustomerService::class);
        $this->app->bind(ISupplierService::class, SupplierService::class);
        $this->app->bind(IMeasurementUnitService::class, MeasurementUnitService::class);
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IInboundService::class, InboundService::class);
        $this->app->bind(IStockService::class, StockService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
