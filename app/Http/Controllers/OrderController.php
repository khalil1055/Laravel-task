<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\CustomerService;
use App\Services\ItemService;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    private OrderService $orderService;
    private ItemService $itemService;

    private CustomerService $customerService;

    public function __construct(OrderService $orderService, ItemService $itemService, CustomerService $customerService)
    {
        $this->orderService = $orderService;
        $this->itemService = $itemService;
        $this->customerService = $customerService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOrderRequest $request
     * @return JsonResponse
     */
    public function store(CreateOrderRequest $request): JsonResponse
    {
        $order_data = $request->validated();

        // get item price
        $order_data['items'] = $this->itemService->getItemsPrice($order_data['items']);

        if (empty($order_data['items'])) {
            return response()->json([
                "message" => "Invalid items data, some items do not exist"
            ], Response::HTTP_BAD_REQUEST);
        }

        $order_data['customer'] = null;
        if (isset($order_data['customer_phone'])) {
            $order_data['customer'] = $this->customerService->findOrCreate($order_data['customer_phone'], $order_data['customer_name']);
        }

        $order = $this->orderService->create($order_data);

        return response()->json([
            "message" => "Order created successfully",
            "status" => "success"
        ], Response::HTTP_CREATED);
    }


}
