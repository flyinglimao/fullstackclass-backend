<?php

use App\Order;
use App\Product;
use Illuminate\Database\Seeder;
use App\Sale;
class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sale::truncate();
        $orders = Order::all();
//        $total = Order::count();
        $fake = \Faker\Factory::create('zh_TW');
        foreach ($orders as $order){
            $product_array = json_decode($order->products,true);
            foreach ($product_array as $product_id=>$quantity)

            Sale::create([
                'change'=>-$quantity,
                'message'=>$fake->realText(rand(10,15)),
                'products_id'=>$product_id,
                'order_id'=>$order->id
            ]);
        }
        foreach (range(1,rand(7,13)) as $id){
            Sale::create([
                'change' => rand(5,10),
                'message'=>$fake->realText(rand(10,15)),
                'products_id'=>Product::inRandomOrder()->first()->id
            ]);
        }

    }
}
