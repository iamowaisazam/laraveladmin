<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        $title = fake()->text(30);
        $slug = Str::slug($title, '-');

        return [
                "title" => $title,
                "slug" => $slug,
                "description" => fake()->text(200),
                "thumbnail" => fake()->imageUrl($width = 200, $height = 200),
                "created_at" => now(),
                "updated_at" => null,
            //
        ];
    }
}
