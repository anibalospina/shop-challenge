<?php

namespace App\Services\Contracts;

interface IPaymentRequestService
{
    public function create(
        int $orderId, string $description, string $total, string $requestId, string $processUrl
    ): void;
}
