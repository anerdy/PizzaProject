<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\PizzaService;
use App\Services\UserService;
use Illuminate\Http\Request;
use \Exception;


class PizzaController extends Controller
{

    /**
     * PizzaController constructor.
     */
    public function __construct()
    {
    }



    public function getPizzas(PizzaService $pizzaService, Request $request)
    {
        return $pizzaService->getPizzas($request);
    }

    public function getPizza(PizzaService $pizzaService, Request $request)
    {
        return $pizzaService->getPizza($request);
    }

    public function getCart(PizzaService $pizzaService, Request $request)
    {
        return $pizzaService->getCart($request);
    }

    public function postCheckout(PizzaService $pizzaService, UserService $userService, OrderService $orderService, Request $request)
    {
        $validator = $pizzaService->validateCheckout($request->all());
        if ($validator->fails()) {
            return [
                'success' => false,
                'errors' => $validator->errors()
            ];
        }
        try {
            $user = $userService->getUserForCheckout($request);
            $pizzas = $pizzaService->getPizzasForCheckout($request);
            if (!$pizzas)
                return [ 'success' => false ];

            $orderService->newOrder()->calculateSubtotal($request, $pizzas)->fillOrder($request, $user)->generateOrderItems($request, $pizzas);
            return [ 'success' => true ];

        } catch (Exception $e) {
            return [ 'success' => false ];
        }
    }
}
