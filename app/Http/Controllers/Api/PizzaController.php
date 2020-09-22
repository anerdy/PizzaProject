<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PizzaService;
use Illuminate\Http\Request;


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

}
