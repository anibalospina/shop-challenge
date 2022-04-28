<?php

namespace App\Services\Contracts;

use App\Entities\Order\OrderRequestEntity;
use App\Entities\Payment\PaymentResponseEntity;

interface IOrderService
{
    public function create(OrderRequestEntity $orderRequestEntity): PaymentResponseEntity;

    public function getById(int $id): array|null;

    public function getAll(): array;
}
