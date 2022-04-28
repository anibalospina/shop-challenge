<?php

namespace App\Http\Controllers;

use App\Entities\Order\OrderRequestEntity;
use App\Http\Requests\CreateOrderRequest;
use App\Services\Contracts\IOrderService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    private IOrderService $orderService;

    public function __construct(IOrderService $orderService)
    {
        $this->orderService = $orderService;
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
