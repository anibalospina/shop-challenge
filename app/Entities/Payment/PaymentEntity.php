<?php

namespace App\Entities\Payment;

class PaymentEntity
{
    public string $reference;
    public string $description;
    public PaymentAmountEntity $amount;
    public bool $allowPartial;

    public function __construct(
        string $reference, string $description, PaymentAmountEntity $amount, bool $allowPartial = false)
    {
        $this->reference = $reference;
        $this->description = $description;
        $this->amount = $amount;
        $this->allowPartial = $allowPartial;
    }
}
