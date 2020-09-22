<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


class PizzaController extends Controller
{

    /**
     * PizzaController constructor.
     */
    public function __construct()
    {
    }



    public function index()
    {
        return Inertia::render('Index');
    }

    public function pizzaPage()
    {
        return Inertia::render('Pizza');
    }

    public function cart(Request $request)
    {
        return Inertia::render('Cart');
    }

    public function checkout(Request $request)
    {
        return Inertia::render('Checkout');
    }

}
