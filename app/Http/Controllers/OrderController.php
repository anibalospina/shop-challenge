<?php

namespace App\Http\Controllers;

use App\Entities\Order\OrderRequestEntity;
use App\Http\Requests\CreateOrderRequest;
use App\Services\Contracts\IOrderService;
use App\Services\Contracts\IPaymentRequestService;
use App\Services\Contracts\IPaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    private IOrderService $orderService;
    private IPaymentRequestService $paymentRequestService;
    private IPaymentService $paymentService;

    public function __construct(IOrderService   $orderService, IPaymentRequestService $paymentRequestService,
                                IPaymentService $paymentService)
    {
        $this->orderService = $orderService;
        $this->paymentRequestService = $paymentRequestService;
        $this->paymentService = $paymentService;
    }

    public function create(CreateOrderRequest $createOrderRequest): JsonResponse
    {
        try {
            DB::beginTransaction();

            $orderData = collect($createOrderRequest->all());
            $paymentCreateResponse = $this->orderService->create(
                new OrderRequestEntity(
                    $orderData->get('customerName'),
                    $orderData->get('customerEmail'),
                    $orderData->get('customerMobile'),
                    $orderData->get('description'),
                    $orderData->get('total'),
                    $orderData->get('currency'),
                )
            );

            DB::commit();

            return response()->json($paymentCreateResponse);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function getByPaymentRequestId(int $paymentRequestId): JsonResponse
    {
        $paymentRequest = $this->paymentRequestService->getByPaymentRequestId($paymentRequestId);
        $order = $this->orderService->getById($paymentRequest->orderId);

        if ($order->status == 'CREATED') {
            $payment = $this->paymentService->getByRequestPaymentId($paymentRequest->requestId);
            $platformStatusPay = $this->orderService->getPlatformStatusPay($payment->status->status);
            $this->orderService->updateStatus($paymentRequest->orderId, $platformStatusPay);
            $order->status = $platformStatusPay;
        }

        if (!is_null($order)) {
            return response()->json(
                new OrderRequestEntity(
                    $order->customerName, $order->customerEmail, $order->customerMobile, $paymentRequest->description,
                    $paymentRequest->total, $paymentRequest->processUrl, $paymentRequest->currency, $order->status
                )
            );
        }
    }

    public function getAll(): JsonResponse
    {
        return response()->json(
            $this->orderService->getAll()
        );
    }
}
