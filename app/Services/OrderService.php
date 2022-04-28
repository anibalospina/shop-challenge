<?php

namespace App\Services;

use App\Entities\Order\OrderRequestEntity;
use App\Entities\Payment\PaymentResponseEntity;
use App\Repositories\Contracts\IOrderRepository;
use App\Services\Contracts\IOrderService;
use App\Services\Contracts\IPaymentRequestService;
use App\Services\Contracts\IPaymentService;

class OrderService implements IOrderService
{
    private IOrderRepository $orderRepository;
    private IPaymentService $paymentService;
    private IPaymentRequestService $paymentRequestService;

    public function __construct(
        IOrderRepository       $orderRepository,
        IPaymentService        $paymentService,
        IPaymentRequestService $paymentRequestService
    )
    {
        $this->orderRepository = $orderRepository;
        $this->paymentService = $paymentService;
        $this->paymentRequestService = $paymentRequestService;
    }

    public function create(OrderRequestEntity $orderRequestEntity): PaymentResponseEntity
    {
        $orderId = $this->orderRepository->create(
            $orderRequestEntity->customerName,
            $orderRequestEntity->customerEmail,
            $orderRequestEntity->customerMobile,
            $orderRequestEntity->status
        );

        $paymentRequest = $this->paymentService->createRequest(
            $this->paymentService->buildPaymentRequest($orderId, $orderRequestEntity)
        );

        $this->paymentRequestService->create(
            $orderId,
            $orderRequestEntity->description,
            $orderRequestEntity->total,
            $paymentRequest->requestId,
            $paymentRequest->processUrl
        );

        return $paymentRequest;
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
