<?php

namespace App\Services\Contracts;

use App\Entities\Order\OrderRequestEntity;
use App\Entities\Payment\PaymentCreatedEntity;
use App\Entities\Payment\PaymentCreateRequestEntity;
use App\Entities\Payment\PaymentCreateResponseEntity;

interface IPaymentService
{
    public function createRequest(PaymentCreateRequestEntity $paymentRequestEntity): PaymentCreateResponseEntity|null;

    public function buildPaymentRequest(
        int $orderId, OrderRequestEntity $orderRequestEntity, int $paymentRequestId): PaymentCreateRequestEntity|null;

    public function getByRequestPaymentId(int $requestPaymentId): PaymentCreatedEntity|null;
}
