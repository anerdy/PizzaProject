<?php

namespace App\Services;

use App\Models\Pizza;
use \Exception;

class PizzaService
{

    public function __construct()
    {
    }


    public function getPizzas($request)
    {
            $pizzas = Pizza::get();
            if ($pizzas) {
                $pizzas = $pizzas->toArray();
                foreach ($pizzas as $id => $pizza) {
                    if ( isset($request->currency) && $request->currency == Pizza::CURRENCY_EUR ) {
                        $pizzas[$id]['price'] = number_format((float) $pizzas[$id]['price'] * Pizza::CURRENCY_EUR_RATE, 2, '.', '');
                        $pizzas[$id]['sign'] = Pizza::CURRENCY_EUR_SIGN;
                    } else {
                        $pizzas[$id]['sign'] = Pizza::CURRENCY_USD_SIGN;
                    }
                }

            }

        return $pizzas;
    }

    public function getPizza($request)
    {
        $pizza = Pizza::where('id', $request->pizza_id)->first();
        if ($pizza) {
            $pizza = $pizza->toArray();
            if ( isset($request->currency) && $request->currency == Pizza::CURRENCY_EUR ) {
                $pizza['price'] = number_format((float) $pizza['price'] * Pizza::CURRENCY_EUR_RATE, 2, '.', '');
                $pizza['sign'] = Pizza::CURRENCY_EUR_SIGN;
            } else {
                $pizza['sign'] = Pizza::CURRENCY_USD_SIGN;
            }
        }

        return $pizza;
    }

    public function getCart($request)
    {
        try {
            $carts = json_decode($request->carts, true);
            $pizzas_ids = array_keys($carts);
            $pizzas = Pizza::whereIn('id', $pizzas_ids)->get();
            $subtotal = 0;
            $sign = '';
            if ($pizzas) {
                $pizzas = $pizzas->toArray();
                foreach ($pizzas as $id => $pizza) {
                    if ( isset( $carts[$pizza['id']] ) ) {

                        if ( isset($request->currency) && $request->currency == Pizza::CURRENCY_EUR ) {
                            $pizzas[$id]['price'] = number_format((float) $pizzas[$id]['price'] * Pizza::CURRENCY_EUR_RATE, 2, '.', '');
                            $pizzas[$id]['sign'] = Pizza::CURRENCY_EUR_SIGN;
                        } else {
                            $pizzas[$id]['sign'] = Pizza::CURRENCY_USD_SIGN;
                        }

                        $sign = $pizzas[$id]['sign'];
                        $pizzas[$id]['quantity'] = $carts[ $pizza['id'] ];
                        $total_pizza_price = $pizzas[$id]['price'] * $carts[ $pizza['id'] ];
                        $pizzas[$id]['total'] = number_format((float) $total_pizza_price, 2, '.', '');
                        $subtotal += $total_pizza_price;
                    }
                }
            }

            $delivery = Pizza::DELIVERY_PRICE;
            $discount = Pizza::DISCOUNT_PRICE;
            $subtotal = number_format((float) $subtotal, 2, '.', '');
            $total = number_format((float) $subtotal + $delivery - $discount, 2, '.', '');
            return [
                'success' => true,
                'pizzas' => $pizzas,
                'subtotal' => $subtotal,
                'delivery' => $delivery,
                'discount' => $discount,
                'total' => $total,
                'sign' => $sign,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => 'Some error'
            ];
        }
    }



}
