<?php

namespace App\Entities\Payment;

class PaymentAmountEntity
{
    public float $total;
    public string|null $currency;

    public function __construct(float $total, string|null $currency = 'USD')
    {
        $this->total = $total;
        $this->currency = $currency;
    }
}
