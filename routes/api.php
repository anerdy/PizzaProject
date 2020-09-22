<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PizzaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/get_pizzas', [PizzaController::class, 'getPizzas'])->name('get_pizzas');
Route::get('/get_pizza/{pizza_id}', [PizzaController::class, 'getPizza'])->where('pizza_id', '[0-9_\-]+')->name('get_pizza');

Route::get('/get_cart', [PizzaController::class, 'getCart'])->name('get_cart');