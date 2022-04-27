<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\Contracts\IOrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderController extends Controller
{
    private IOrderService $orderService;

    public function __construct(IOrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function create(CreateOrderRequest $createOrderRequest): Response
    {
        $orderData = $createOrderRequest->all();

        $this->orderService->create(
            $orderData['customerName'], $orderData['customerEmail'], $orderData['customerMobile']
        );

        return response()->noContent();
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
