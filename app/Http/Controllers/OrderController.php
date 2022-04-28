<?php

namespace App\Http\Controllers;

use App\Entities\Order\OrderRequestEntity;
use App\Entities\Payment\PaymentAmountEntity;
use App\Entities\Payment\PaymentAuthEntity;
use App\Entities\Payment\PaymentEntity;
use App\Entities\Payment\PaymentPayerEntity;
use App\Entities\Payment\PaymentRequestEntity;
use App\Http\Requests\CreateOrderRequest;
use App\Services\Contracts\IOrderService;
use App\Services\Contracts\IPaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    private IOrderService $orderService;
    private IPaymentService $paymentService;

    public function __construct(IOrderService $orderService, IPaymentService $paymentService)
    {
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
    }

    public function create(CreateOrderRequest $createOrderRequest): JsonResponse
    {
        $orderData = collect($createOrderRequest->all());

        return response()->json(
            $this->orderService->create(
                new OrderRequestEntity(
                    $orderData->get('customerName'),
                    $orderData->get('customerEmail'),
                    $orderData->get('customerMobile'),
                    $orderData->get('description'),
                    $orderData->get('total'),
                    $orderData->get('currency'),
                )
            )
        );
    }

    public function getById(int $id): JsonResponse
    {
        $order = $this->orderService->getById($id);

        if (is_null($order)) {
            throw new NotFoundHttpException();
        }

        return response()->json($order);
    }

    public function getAll(): JsonResponse
    {
        return response()->json(
            $this->orderService->getAll()
        );
    }
}
