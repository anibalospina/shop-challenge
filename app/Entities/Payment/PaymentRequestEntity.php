<?php

namespace App\Entities\Payment;

class PaymentRequestEntity
{
    public string $locale;
    public PaymentAuthEntity $auth;
    public PaymentPayerEntity $payer;
    public PaymentEntity $payment;
    public string $expiration;
    public string $returnUrl;
    public string $ipAddress;
    public string $userAgent;
}
