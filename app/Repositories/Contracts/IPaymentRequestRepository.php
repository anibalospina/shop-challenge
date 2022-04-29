<?php

namespace App\Repositories\Contracts;

use App\Entities\Payment\PaymentRequestEntity;

interface IPaymentRequestRepository
{
    public function create(
        int    $orderId, string $description, string $total, string $requestId = null, string $processUrl = null,
        string $currency = 'USD'
    ): int;

    public function getByPaymentRequestId(int $paymentRequestId): array|null;

    public function updatePaymentInfo(string $id, string $requestId, string $processUrl): void;
}
