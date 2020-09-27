<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;


class OrderController extends Controller
{

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
    }



    public function getUserOrders(OrderService $orderService, Request $request)
    {
        return $orderService->getUserOrders($request);
    }

}
