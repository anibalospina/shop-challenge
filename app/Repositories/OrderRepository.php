<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\IOrderRepository;

class OrderRepository implements IOrderRepository
{
    public function create(
        string $customerName, string $customerEmail, string $customerMobile, string $status = 'CREATED'
    ): int
    {
        $order = new Order();
        $order->customer_name = $customerName;
        $order->customer_email = $customerEmail;
        $order->customer_mobile = $customerMobile;
        $order->status = $status;

        $order->save();

        return $order->id;
    }

    public function getById(int $id): array|null
    {
        return Order::find($id)->toArray();
    }

    public function getAll(): array
    {
        return Order::all()->toArray();
    }
}
