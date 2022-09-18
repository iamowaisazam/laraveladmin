<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /*
     * Run the database seeders.
     */
    public function run()
    {   
        Order::factory(50)->create();
        foreach (Order::all() as $value){
            OrderItem::create([
                "product_id" => Product::all()->random()->id,
                "order_id" => $value->id,
                "price" => 5,
                "created_at" => now(),
                "updated_at" =>  null,
            ]);
        }
    }
}