<?php

namespace App\Providers;

use App\Repositories\Contracts\IOrderRepository;
use App\Repositories\Contracts\IPaymentRequestRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PaymentRequestRepository;
use App\Services\Contracts\IOrderService;
use App\Services\Contracts\IPaymentRequestService;
use App\Services\Contracts\IPaymentService;
use App\Services\OrderService;
use App\Services\PaymentRequestService;
use App\Services\PaymentService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //List services
        $this->app->bind(IOrderService::class, OrderService::class);
        $this->app->bind(IPaymentService::class, PaymentService::class);
        $this->app->bind(IPaymentRequestService::class, PaymentRequestService::class);

        //List repositories
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(IPaymentRequestRepository::class, PaymentRequestRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
