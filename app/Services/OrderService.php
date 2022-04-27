<?php

namespace App\Services;

use App\Repositories\Contracts\IOrderRepository;
use App\Services\Contracts\IOrderService;

class OrderService implements IOrderService
{
    private IOrderRepository $orderRepository;

    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function create(
        string $customerName, string $customerEmail, string $customerMobile, string $status = 'CREATED'
    ): void
    {
        $this->orderRepository->create($customerName, $customerEmail, $customerMobile, $status);
    }

    public function getById(int $id): array|null
    {
        return $this->orderRepository->getById($id);
    }

    public function getAll(): array
    {
        return $this->orderRepository->getAll();
    }
}
