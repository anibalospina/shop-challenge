<?php

namespace App\Services\Contracts;

use App\Entities\Order\OrderRequestEntity;
use App\Entities\Payment\PaymentRequestEntity;
use App\Entities\Payment\PaymentResponseEntity;

interface IPaymentService
{
    public function createRequest(PaymentRequestEntity $paymentRequestEntity): PaymentResponseEntity|null;

    public function buildPaymentRequest(
        int $orderId, OrderRequestEntity $orderRequestEntity): PaymentRequestEntity|null;
}
