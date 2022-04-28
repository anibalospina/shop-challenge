<?php

namespace App\Entities\Payment;

class PaymentPayerEntity
{
    public string $name;
    public string $email;
    public string $mobile;

    public function __construct(string $name, string $email, string $mobile)
    {
        $this->name = $name;
        $this->email = $email;
        $this->mobile = $mobile;
    }
}
