<?php

namespace App\Services;

use App\Entities\Order\OrderRequestEntity;
use App\Entities\Payment\PaymentAmountEntity;
use App\Entities\Payment\PaymentAuthEntity;
use App\Entities\Payment\PaymentEntity;
use App\Entities\Payment\PaymentPayerEntity;
use App\Entities\Payment\PaymentRequestEntity;
use App\Entities\Payment\PaymentResponseEntity;
use App\Repositories\Contracts\IOrderRepository;
use App\Services\Contracts\IOrderService;
use App\Services\Contracts\IPaymentService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class OrderService implements IOrderService
{
    private IOrderRepository $orderRepository;
    private IPaymentService $paymentService;

    public function __construct(IOrderRepository $orderRepository, IPaymentService $paymentService)
    {
        $this->orderRepository = $orderRepository;
        $this->paymentService = $paymentService;
    }

    public function create(OrderRequestEntity $orderRequestEntity): PaymentResponseEntity
    {
        $orderId = $this->orderRepository->create(
            $orderRequestEntity->customerName,
            $orderRequestEntity->customerEmail,
            $orderRequestEntity->customerMobile,
            $orderRequestEntity->status
        );

        return $this->paymentService->createRequest(
            $this->paymentService->buildPaymentRequest($orderId, $orderRequestEntity)
        );
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
