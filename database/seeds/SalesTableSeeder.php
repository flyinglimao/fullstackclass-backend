<?php

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
        $total = 10;
        $fake = \Faker\Factory::create('zh_TW');
        foreach (range(1,$total) as $id){
            Sale::create([
                'change'=>rand(1,3),
                'message'=>$fake->realText(rand(10,15)),
                'products_id'=>rand(100,999),
                'order_id'=>$id
            ]);
        }

    }
}
