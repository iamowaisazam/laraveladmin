<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run()
    {   
        Product::factory(50)->create();
    }
}