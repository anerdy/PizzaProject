<?php

namespace Database\Seeders;

use App\Models\Pizza;
use Illuminate\Database\Seeder;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizza = new Pizza();
        $pizza->name = 'Caprese';
        $pizza->description = 'Simple and easy pizza with mozzarella, tomatoes and gourmet pesto with balsamic caramel.';
        $pizza->price = 10;
        $pizza->image_url = '/images/pizzas/1.jpeg';
        $pizza->save();
        $pizza = new Pizza();
        $pizza->name = 'El Paso';
        $pizza->description = 'Hot Mexican pizza with spicy beef, corn, bell peppers and jalapenos.';
        $pizza->price = 10;
        $pizza->image_url = '/images/pizzas/2.jpeg';
        $pizza->save();
        $pizza = new Pizza();
        $pizza->name = 'Farmer\'s';
        $pizza->description = 'Original pizza with smoked potatoes, tender bacon, pickled cucumbers, crispy onions and tartar sauce.';
        $pizza->price = 10;
        $pizza->image_url = '/images/pizzas/3.jpeg';
        $pizza->save();
        $pizza = new Pizza();
        $pizza->name = 'Four seasons';
        $pizza->description = 'Two hearty meat pizzas and two vegetarian pizzas in one - pepperoni, ham, mushrooms and a bright vegetable mix.';
        $pizza->price = 10;
        $pizza->image_url = '/images/pizzas/4.jpeg';
        $pizza->save();


        $pizza = new Pizza();
        $pizza->name = 'Cheese';
        $pizza->description = 'Double mozzarella and tomato sauce is a minimalistic dish for the most selective in food.';
        $pizza->price = 10;
        $pizza->image_url = '/images/pizzas/5.jpeg';
        $pizza->save();
        $pizza = new Pizza();
        $pizza->name = 'Amsterdam';
        $pizza->description = 'Delicate ham, champignons, soft mozzarella - a well-known delicious combination, and nothing more.';
        $pizza->price = 10;
        $pizza->image_url = '/images/pizzas/6.jpeg';
        $pizza->save();
        $pizza = new Pizza();
        $pizza->name = 'BBQ';
        $pizza->description = 'Aromatic bacon, chicken, ham and bell peppers. Traditional American barbecue sauce gives the pizza a unique taste.';
        $pizza->price = 10;
        $pizza->image_url = '/images/pizzas/7.jpeg';
        $pizza->save();
        $pizza = new Pizza();
        $pizza->name = 'Vegetarian';
        $pizza->description = 'Zucchini, cubes of refreshing cheese, bell peppers, olives, red onion and oregano.';
        $pizza->price = 10;
        $pizza->image_url = '/images/pizzas/8.jpeg';
        $pizza->save();

        $pizza = new Pizza();
        $pizza->name = 'Hawaiian';
        $pizza->description = 'Pizza for connoisseurs of non-standard flavor combinations: tender ham, chicken and juicy pineapple.';
        $pizza->price = 10;
        $pizza->image_url = '/images/pizzas/9.jpeg';
        $pizza->save();
        $pizza = new Pizza();
        $pizza->name = 'Margarita';
        $pizza->description = 'Lightly baked tomato cubes, soft, viscous mozzarella and a little oregano for flavor - the classic Margarita.';
        $pizza->price = 10;
        $pizza->image_url = '/images/pizzas/10.jpeg';
        $pizza->save();
        $pizza = new Pizza();
        $pizza->name = 'Pepperoni';
        $pizza->description = 'Simple as all ingenious, spicy pizza with spicy Italian sausage pepperoni and jalapeno pepper.';
        $pizza->price = 10;
        $pizza->image_url = '/images/pizzas/11.jpeg';
        $pizza->save();
        $pizza = new Pizza();
        $pizza->name = 'Mexico';
        $pizza->description = 'Spicy pizza with pepperoni, beef, bell pepper and hot jalapenos.';
        $pizza->price = 10;
        $pizza->image_url = '/images/pizzas/12.jpeg';
        $pizza->save();
    }
}
