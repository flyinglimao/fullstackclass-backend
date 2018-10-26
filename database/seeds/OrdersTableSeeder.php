<?php

use Illuminate\Database\Seeder;
use App\Order;
class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::truncate();
        $total = 10;
        foreach (range(1,$total) as $id){
            Order::create();
        }
    }
}
