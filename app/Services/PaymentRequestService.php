<?php

namespace App\Services;

use App\Entities\Payment\PaymentRequestEntity;
use App\Repositories\Contracts\IPaymentRequestRepository;
use App\Services\Contracts\IPaymentRequestService;

class PaymentRequestService implements IPaymentRequestService
{
    private IPaymentRequestRepository $paymentRequestRepository;

    public function __construct(IPaymentRequestRepository $paymentRequestRepository)
    {
        $this->paymentRequestRepository = $paymentRequestRepository;
    }

    public function create(
        int    $orderId, string $description, string $total, string $requestId = null, string $processUrl = null,
        string $currency = 'USD'
    ): int
    {
        return $this->paymentRequestRepository->create($orderId, $description, $total, $requestId, $processUrl);
    }

    public function getByPaymentRequestId(int $paymentRequestId): PaymentRequestEntity|null
    {
        $paymentRequest = $this->paymentRequestRepository->getByPaymentRequestId($paymentRequestId);

        return new PaymentRequestEntity(
            $paymentRequest['description'], $paymentRequest['currency'], $paymentRequest['total'],
            $paymentRequest['request_id'], $paymentRequest['process_url'], $paymentRequest['order_id']
        );
    }

    public function updatePaymentInfo(string $id, string $requestId, string $processUrl): void
    {
        $this->paymentRequestRepository->updatePaymentInfo($id, $requestId, $processUrl);
    }
}
