<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    
    /**
     * Define the model's default state
     */
    public function definition()
    {   
        return [
                "ref" => fake()->name(),
                "status" => fake()->randomElements(['pending','approved','cancel'])[0],
                "date" => now(),
                "notes" => fake()->text(100),  
                "customer_id" =>  Customer::all()->random()->id,
                "tax" =>  fake()->randomDigit(),
                "discount" => fake()->randomDigit(),
                "created_at" => now(),
                "updated_at" => null,
              ];
    }

}
