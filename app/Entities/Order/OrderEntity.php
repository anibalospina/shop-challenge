<?php

namespace App\Entities\Order;

class OrderEntity
{
    public string $customerName;
    public string $customerEmail;
    public string $customerMobile;
    public string $status;

    public function __construct(string $customerName, string $customerEmail, string $customerMobile, string $status)
    {
        $this->customerName = $customerName;
        $this->customerEmail = $customerEmail;
        $this->customerMobile = $customerMobile;
        $this->status = $status;
    }
}
