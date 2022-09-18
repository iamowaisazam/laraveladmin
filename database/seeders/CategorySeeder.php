<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\Category;
use App\Models\SubCategory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run()
    {   
        Category::factory(50)->create();
        $parentCategories = Category::take(10)->pluck('id')->toArray();

        foreach ($parentCategories as $value) {
            SubCategory::create([
                'parent' => $value,
                'child' => Category::whereNotIn('id',$parentCategories)->get()->random()->id,
                'created_at' => now(),
                'updated_at' => null, 
            ]);

            SubCategory::create([
                'parent' => $value,
                'child' => Category::whereNotIn('id',$parentCategories)->get()->random()->id,
                'created_at' => now(),
                'updated_at' => null, 
            ]);

            SubCategory::create([
                'parent' => $value,
                'child' => Category::whereNotIn('id',$parentCategories)->get()->random()->id,
                'created_at' => now(),
                'updated_at' => null, 
            ]);
        }
    }
}