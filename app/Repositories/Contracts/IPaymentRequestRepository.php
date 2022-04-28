<?php

namespace App\Repositories\Contracts;

interface IPaymentRequestRepository
{
    public function create(
        int $orderId, string $description, string $total, string $requestId, string $processUrl
    ): void;
}
