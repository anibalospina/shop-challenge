<?php

namespace App\Services\Contracts;

interface IOrderService
{
    public function create(
        string $customerName, string $customerEmail, string $customerMobile, string $status = 'CREATED'
    ): void;

    public function getById(int $id): array|null;

    public function getAll(): array;
}
