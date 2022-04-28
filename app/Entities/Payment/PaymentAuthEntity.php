<?php

namespace App\Entities\Payment;

class PaymentAuthEntity
{
    public string $login;
    public string $tranKey;
    public string $nonce;
    public string $seed;

    public function __construct(string $login, string $tranKey, string $nonce, string $seed)
    {
        $this->login = $login;
        $this->tranKey = $tranKey;
        $this->nonce = $nonce;
        $this->seed = $seed;
    }
}
