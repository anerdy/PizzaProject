<?php

namespace App\Services;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Pizza;

class OrderService
{

    /**
     * @var Order $order
     */
    private $order;
    /**
     * @var $subtotal
     */
    private $subtotal;


    /**
     * @return $this
     */
    public function newOrder()
    {
        $this->order = new Order();
        return $this;
    }

    /**
     * @param $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getUserOrders($request)
    {
        $orders = Order::where('user_id', $request->user_id)->orderByDesc('id')->get();
        if ($orders) {
            return [
                'success' => true,
                'orders' => OrderResource::collection($orders)
            ];
        }
        return [
            'success' => false,
            'error' => 'Empty orders'
        ];
    }


    /**
     * @param $request
     * @param $pizzas
     * @return $this
     */
    public function calculateSubtotal($request, $pizzas)
    {
        foreach ($pizzas as $pizza) {
            if ( isset( $request->carts[$pizza->id] ) ) {
                $total_pizza_price = $pizza->price * $request->carts[$pizza->id];
                $this->subtotal += $total_pizza_price;
            }
        }
        return $this;
    }

    /**
     * @param $request
     * @return $this
     */
    public function fillOrder($request, $user)
    {
        $delivery = Pizza::DELIVERY_PRICE;
        $discount = Pizza::DISCOUNT_PRICE;
        $subtotal = number_format((float) $this->subtotal, 2, '.', '');
        $total = number_format((float) $subtotal + $delivery - $discount, 2, '.', '');

        if (!is_null($user))
            $this->order->user_id = $user->id;
        $this->order->firstname = $request->firstname;
        $this->order->lastname = $request->lastname;
        $this->order->address = $request->address;
        $this->order->phone = $request->phone;
        $this->order->email = $request->email;
        $this->order->subtotal = $subtotal;
        $this->order->delivery = $delivery;
        $this->order->discount = $discount;
        $this->order->total = $total;
        $this->order->save();

        return $this;
    }

    /**
     * @param $request
     * @param $pizzas
     */
    public function generateOrderItems($request, $pizzas)
    {
        foreach ($pizzas as $pizza) {
            if ( isset( $request->carts[$pizza->id] ) ) {
                $this->order->pizzas()->syncWithoutDetaching([ $pizza->id => [ 'price' => $pizza->price, 'count' => $request->carts[$pizza->id] ] ]);
            }
        }
    }

}
