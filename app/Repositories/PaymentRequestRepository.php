<?php

namespace App\Repositories;

use App\Models\PaymentRequest;
use App\Repositories\Contracts\IPaymentRequestRepository;

class PaymentRequestRepository implements IPaymentRequestRepository
{
    public function create(
        int    $orderId, string $description, string $total, string $requestId = null, string $processUrl = null,
        string $currency = 'USD'
    ): int
    {
        $paymentRequest = new PaymentRequest();

        $paymentRequest->order_id = $orderId;
        $paymentRequest->description = $description;
        $paymentRequest->total = $total;
        $paymentRequest->request_id = $requestId;
        $paymentRequest->process_url = $processUrl;
        $paymentRequest->currency = $currency;

        $paymentRequest->save();

        return $paymentRequest->id;
    }

    public function getByPaymentRequestId(int $paymentRequestId): array|null
    {
        return PaymentRequest::findOrFail($paymentRequestId)->toArray();
    }

    public function updatePaymentInfo(string $id, string $requestId, string $processUrl): void
    {
        $paymentRequest = PaymentRequest::findOrFail($id);

        $paymentRequest->request_id = $requestId;
        $paymentRequest->process_url = $processUrl;

        $paymentRequest->save();
    }
}
