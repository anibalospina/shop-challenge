<?php

namespace App\Services\Contracts;

use App\Entities\Payment\PaymentRequestEntity;

interface IPaymentRequestService
{
    public function create(
        int    $orderId, string $description, string $total, string $requestId = null, string $processUrl = null,
        string $currency = 'USD'
    ): int;

    public function getByPaymentRequestId(int $paymentRequestId): PaymentRequestEntity|null;

    public function updatePaymentInfo(string $id, string $requestId, string $processUrl): void;
}
