<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;


class OrderController extends Controller
{
    /**
     * OrderController constructor.
     */
    public function __construct()
    {
    }

    public function dashboard(Request $request, UserService $userService)
    {
        $user_token = $userService->getUserToken($request);
        if (!is_null($user_token))
            Inertia::share('user_token', $user_token->plainTextToken);
        return Inertia::render('Orders');
    }

}
