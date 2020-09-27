<?php

namespace App\Services;

use App\Models\Pizza;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use \Exception;

class PizzaService
{

    /**
     * @param $request
     * @return mixed
     */
    public function getPizzas($request)
    {
        $pizzas = Pizza::get();
        if ($pizzas) {
            $pizzas = $pizzas->toArray();
            foreach ($pizzas as $id => $pizza) {
                $pizzas[$id] = $this->generateSign($request, $pizzas[$id]);
            }
        }

        return $pizzas;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getPizza($request)
    {
        $pizza = Pizza::where('id', $request->pizza_id)->first();
        if ($pizza) {
            $pizza = $pizza->toArray();
            $pizza = $this->generateSign($request, $pizza);
        }

        return $pizza;
    }

    /**
     * @param $request
     * @return array
     */
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
                        $pizzas[$id] = $this->generateSign($request, $pizzas[$id]);

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

    /**
     * @param $request
     * @param $pizza
     * @return mixed
     */
    public function generateSign($request, $pizza)
    {
        if ( isset($request->currency) && $request->currency == Pizza::CURRENCY_EUR ) {
            $pizza['price'] = number_format((float) $pizza['price'] * Pizza::CURRENCY_EUR_RATE, 2, '.', '');
            $pizza['sign'] = Pizza::CURRENCY_EUR_SIGN;
        } else {
            $pizza['sign'] = Pizza::CURRENCY_USD_SIGN;
        }
        return $pizza;
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateCheckout($data)
    {
        $rules = [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'is_create_account' => ['required', 'integer'],
        ];

        if ($data['is_create_account'] == User::CREATE_ACCOUNT) {
            $rules = array_merge($rules, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'max:250', 'string'],
            ]);
        }
        $validator = Validator::make($data, $rules);

        return $validator;
    }


    /**
     * @param $request
     * @return mixed
     */
    public function getPizzasForCheckout($request)
    {
        $carts = $request->carts;
        $pizzas_ids = array_keys($carts);
        return Pizza::whereIn('id', $pizzas_ids)->get();
    }



}
