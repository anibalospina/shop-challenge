<?php

namespace App\Providers;

use App\Repositories\Contracts\IOrderRepository;
use App\Repositories\OrderRepository;
use App\Services\Contracts\IOrderService;
use App\Services\Contracts\IPaymentService;
use App\Services\OrderService;
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

        //List repositories
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
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
