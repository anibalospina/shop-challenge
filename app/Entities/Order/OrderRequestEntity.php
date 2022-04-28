<?php

namespace App\Entities\Order;

class OrderRequestEntity
{
    public string $customerName;
    public string $customerEmail;
    public string $customerMobile;
    public string $description;
    public string $total;
    public string|null $currency;
    public string|null $status;

    public function __construct(
        string      $customerName, string $customerEmail, string $customerMobile, string $description, string $total,
        string|null $currency = 'USD', string|null $status = 'CREATED')
    {
        $this->customerName = $customerName;
        $this->customerEmail = $customerEmail;
        $this->customerMobile = $customerMobile;
        $this->description = $description;
        $this->total = $total;
        $this->currency = $currency;
        $this->status = $status;
    }
}
