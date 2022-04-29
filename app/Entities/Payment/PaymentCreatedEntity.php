<?php

namespace App\Entities\Payment;

class PaymentCreatedEntity
{
    public string $requestId;
    public PaymentCreatedStatusEntity $status;

    public function __construct(string $requestId, PaymentCreatedStatusEntity $status)
    {
        $this->requestId = $requestId;
        $this->status = $status;
    }
}
