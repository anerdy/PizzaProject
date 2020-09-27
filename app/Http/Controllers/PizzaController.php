<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;


class PizzaController extends Controller
{


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

    public function success(Request $request)
    {
        return Inertia::render('Success');
    }
}
