<?php

namespace App\Services;

use App\Entities\Order\OrderEntity;
use App\Entities\Order\OrderRequestEntity;
use App\Entities\Payment\PaymentCreateResponseEntity;
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

    public function create(OrderRequestEntity $orderRequestEntity): PaymentCreateResponseEntity
    {
        $orderId = $this->orderRepository->create(
            $orderRequestEntity->customerName,
            $orderRequestEntity->customerEmail,
            $orderRequestEntity->customerMobile,
            $orderRequestEntity->status
        );

        $paymentRequestId = $this->paymentRequestService->create(
            $orderId,
            $orderRequestEntity->description,
            $orderRequestEntity->total,
            null,
            null,
            $orderRequestEntity->currency
        );

        $paymentRequest = $this->paymentService->createRequest(
            $this->paymentService->buildPaymentRequest($orderId, $orderRequestEntity, $paymentRequestId)
        );

        $this->paymentRequestService->updatePaymentInfo(
            $paymentRequestId,
            $paymentRequest->requestId,
            $paymentRequest->processUrl
        );

        return $paymentRequest;
    }

    public function getById(int $id): OrderEntity|null
    {
        $order = $this->orderRepository->getById($id);

        return new OrderEntity(
            $order['customer_name'], $order['customer_email'], $order['customer_mobile'], $order['status']
        );
    }

    public function getAll(): array
    {
        return $this->orderRepository->getAll();
    }
}
