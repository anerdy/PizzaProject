<?php

namespace App\Http\Resources;

use App\Models\Pizza;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ( isset($request->currency) && $request->currency == Pizza::CURRENCY_EUR ) {
            $subtotal = number_format((float) $this->subtotal * Pizza::CURRENCY_EUR_RATE, 2, '.', '');
            $delivery = number_format((float) $this->delivery * Pizza::CURRENCY_EUR_RATE, 2, '.', '');
            $discount = number_format((float) $this->discount * Pizza::CURRENCY_EUR_RATE, 2, '.', '');
            $total = number_format((float) $this->total * Pizza::CURRENCY_EUR_RATE, 2, '.', '');
            $sign = Pizza::CURRENCY_EUR_SIGN;
        } else {
            $subtotal = $this->subtotal;
            $delivery = $this->delivery;
            $discount = $this->discount;
            $total = $this->total;
            $sign = Pizza::CURRENCY_USD_SIGN;
        }

        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'subtotal' => $subtotal,
            'delivery' => $delivery,
            'discount' => $discount,
            'total' => $total,
            'sign' => $sign,
            'pizzas' => OrderPizzaResource::collection($this->pizzas),
        ];
    }
}
