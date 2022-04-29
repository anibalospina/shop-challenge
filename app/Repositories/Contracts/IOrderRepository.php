<?php

namespace App\Repositories\Contracts;

use App\Entities\Order\OrderEntity;

interface IOrderRepository
{
    public function create(
        string $customerName, string $customerEmail, string $customerMobile, string $status = 'CREATED'
    ): int;

    public function getById(int $id): array|null;

    public function getAll(): array;
}
