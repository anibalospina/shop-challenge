<?php

namespace App\Entities\Payment;

class PaymentCreatedStatusEntity
{
    public string $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }
}
