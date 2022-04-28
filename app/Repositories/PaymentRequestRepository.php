<?php

namespace App\Repositories;

use App\Models\PaymentRequest;
use App\Repositories\Contracts\IPaymentRequestRepository;

class PaymentRequestRepository implements IPaymentRequestRepository
{
    public function create(
        int $orderId, string $description, string $total, string $requestId, string $processUrl
    ): void
    {
        $paymentRequest = new PaymentRequest();

        $paymentRequest->order_id = $orderId;
        $paymentRequest->description = $description;
        $paymentRequest->total = $total;
        $paymentRequest->request_id = $requestId;
        $paymentRequest->process_url = $processUrl;

        $paymentRequest->save();
    }
}
