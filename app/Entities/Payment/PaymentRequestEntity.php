<?php

namespace App\Entities\Payment;

class PaymentRequestEntity
{
    public string $description;
    public string $currency;
    public float $total;
    public string $requestId;
    public string $processUrl;
    public int $orderId;

    public function __construct(string $description, string $currency, float $total, string $requestId,
                                string $processUrl, int $orderId
    )
    {
        $this->description = $description;
        $this->currency = $currency;
        $this->total = $total;
        $this->requestId = $requestId;
        $this->processUrl = $processUrl;
        $this->orderId = $orderId;
    }
}
