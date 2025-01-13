<?php

namespace App\Providers;

use App\Application\Interfaces\AuthServiceInterface;
use App\Application\Interfaces\ICompanyService;
use App\Application\Interfaces\ICustomerService;
use App\Application\Interfaces\IInboundService;
use App\Application\Interfaces\IInvoiceService;
use App\Application\Interfaces\IMeasurementUnitService;
use App\Application\Interfaces\IOrderService;
use App\Application\Interfaces\IProductService;
use App\Application\Interfaces\IQuotationService;
use App\Application\Interfaces\IStockService;
use App\Application\Interfaces\ISupplierService;
use App\Application\Interfaces\IUserService;
use App\Application\Interfaces\IWarehouseService;
use App\Application\Interfaces\UserServiceInterface;
use App\Application\Services\InvoiceService;
use App\Application\Services\OrderService;
use App\Application\Services\QuotationService;
use App\Application\Services\StockService;
use App\Infrastructure\Interfaces\IInboundItemRepository;
use App\Infrastructure\Interfaces\IInvoiceItemRepository;
use App\Infrastructure\Interfaces\IInvoiceRepository;
use App\Infrastructure\Interfaces\IOrderItemRepository;
use App\Infrastructure\Interfaces\IOrderRepository;
use App\Infrastructure\Interfaces\IQuotationItemRepository;
use App\Infrastructure\Interfaces\IQuotationRepository;
use App\Infrastructure\Interfaces\IUserRepository;
use App\Infrastructure\Repositories\InvoiceRepository;
use App\Infrastructure\Repositories\OrderItemRepository;
use App\Infrastructure\Repositories\OrderRepository;
use App\Infrastructure\Repositories\QuotationItemRepository;
use App\Infrastructure\Repositories\QuotationRepository;
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
        $this->app->bind(ICompanyRepository::class, CompanyRepository::class);
        $this->app->bind(ICustomerRepository::class, CustomerRepository::class);
        $this->app->bind(IInboundItemRepository::class, IInboundItemRepository::class);
        $this->app->bind(IInboundRepository::class, InboundRepository::class);
        $this->app->bind(IInvoiceItemRepository::class, IInvoiceItemRepository::class);
        $this->app->bind(IInvoiceRepository::class, InvoiceRepository::class);
        $this->app->bind(IMeasurementUnitRepository::class, MeasurementUnitRepository::class);
        $this->app->bind(IOrderItemRepository::class, OrderItemRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IQuotationItemRepository::class, QuotationItemRepository::class);
        $this->app->bind(IQuotationRepository::class, QuotationRepository::class);
        $this->app->bind(IStockRepository::class, StockRepository::class);
        $this->app->bind(ISupplierRepository::class, SupplierRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IWarehouseRepository::class, WarehouseRepository::class);

        // Service Bindings
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
        $this->app->bind(ICompanyService::class, CompanyService::class);
        $this->app->bind(ICustomerService::class, CustomerService::class);
        $this->app->bind(IInboundService::class, InboundService::class);
        $this->app->bind(IInvoiceService::class, InvoiceService::class);
        $this->app->bind(IMeasurementUnitService::class, MeasurementUnitService::class);
        $this->app->bind(IOrderService::class, OrderService::class);
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IQuotationService::class, QuotationService::class);
        $this->app->bind(IStockService::class, StockService::class);
        $this->app->bind(ISupplierService::class, SupplierService::class);
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IWarehouseService::class, WarehouseService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
