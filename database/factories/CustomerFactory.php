<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    /**
     * Define the model's default state
     */
    public function definition()
    {   
        $name = fake()->name();
        $phone = 'asdasdasd';

        return [
            "name" => $name,
            "email" => $name.'@gmail.com',
            "phone" => $phone,
            "country" => fake()->country(),
            "street_address" => fake()->address(),
            "city" => fake()->city(),
            "state" => fake()->state(),
            "zip_code" => 'asdasd',
            "details" => fake()->sentence(),
            "created_at" => null,
            "updated_at" => null,
        ];
    }
}
