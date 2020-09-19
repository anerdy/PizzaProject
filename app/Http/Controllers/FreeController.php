<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;


class FreeController extends Controller
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
    }



    public function index()
    {
        $data = '123333';
        return Inertia::render('Index', ['data' => $data] );
    }

    public function about(Request $request)
    {
        return Inertia::render('About');
    }

}
