<?php

namespace App\Services\Contracts;

use App\Entities\Order\OrderEntity;
use App\Entities\Order\OrderRequestEntity;
use App\Entities\Payment\PaymentCreateResponseEntity;

interface IOrderService
{
    public function create(OrderRequestEntity $orderRequestEntity): PaymentCreateResponseEntity;

    public function getById(int $id): OrderEntity|null;

    public function getAll(): array;

    public function updateStatus(int $id, string $status): void;

    public function getPlatformStatusPay(string $status): string|null;
}
