<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {   
        $title = fake()->text(30);

        return [
            "title" => $title,
            "slug" => Str::slug($title, '-'),
            "description" => fake()->text(200),
            "thumbnail" => fake()->imageUrl($width = 200, $height = 200),
            "price" => fake()->randomDigit(),
            "sku" => Str::random(30),
            "category_id" => Category::pluck('id')->random(),
            "created_at" => now(),
            "updated_at" => null ,
        ];
    }
}
