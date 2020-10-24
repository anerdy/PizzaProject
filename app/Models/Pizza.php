<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pizza
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $image_url
 */
class Pizza extends Model
{
    protected $table = 'pizzas';

    const DELIVERY_PRICE = 1.00;
    const DISCOUNT_PRICE = 0.00;

    const CURRENCY_EUR = 'EUR';
    const CURRENCY_EUR_RATE = 0.84;
    const CURRENCY_USD_SIGN = '$';
    const CURRENCY_EUR_SIGN = '€';


    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
    ];

    protected $visible = [
        'id',
        'name',
        'description',
        'price',
        'image_url',
    ];


}
