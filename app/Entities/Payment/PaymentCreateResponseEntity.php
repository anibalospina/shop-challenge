<?php

namespace App\Entities\Payment;

class PaymentCreateResponseEntity
{
    public string $requestId;
    public string $processUrl;

    public function __construct(string $requestId, string $processUrl)
    {
        $this->requestId = $requestId;
        $this->processUrl = $processUrl;
    }
}
