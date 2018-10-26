<?php

use Illuminate\Database\Seeder;
use App\Order;
use Faker\Factory as Faker;

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
    $faker = Faker::create();
    $total = 10;
    foreach (range(1,$total) as $id){
      Order::create([
        'state' => 0,
        'pay_method' => 0,
        'payment' => substr($faker->text, 0, 32),
        'message' => substr($faker->text, 0, 32),
        'ship_method' => 0,
        'ship_information' => substr($faker->text, 0, 32),
        'ship_order' => $id,
        'products' => json_encode([0, 1, 2]),
        'receiver' => $faker->name,
        'receiver_phone' => '0987987987',
        'invoice_number' => 'null',
        'coupon' => 'FREE',
      ]);
    }
  }
}
