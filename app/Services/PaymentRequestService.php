<?php

namespace App\Services;

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
        int $orderId, string $description, string $total, string $requestId, string $processUrl
    ): void
    {
        $this->paymentRequestRepository->create($orderId, $description, $total, $requestId, $processUrl);
    }
}
