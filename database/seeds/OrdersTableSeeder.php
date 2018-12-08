<?php

use App\Product;
use App\User;
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
    $total = 20;

    $fake = \Faker\Factory::create('zh_TW');
    foreach (range(1,$total) as $id){
      $product_array = [];
      $total = 0;
      foreach (range(1,rand(1,4)) as $ii){
          $product_id = Product::inRandomOrder()->first()->id;
          if (!array_key_exists($product_id,$product_array)){
              $product_array+=[$product_id=>rand(1,4)];
              $total += $product_array[$product_id]*(Product::find($product_id)->sale_price);
          }
      }
      Order::create([
        'state'=>rand(0,1),
        'pay_method'=>0,
        'payment_information'=>json_encode([
          'time'=>now(),
          'total'=>$total,
        ]),
        'message'=>$fake->realText(rand(10,15)),
        'ship_method'=>0,
        'ship_information'=>'快樂物流',
        'ship_order'=>'FIFO',
        'products'=>json_encode($product_array),
        'receiver'=>$this->randname(rand(6,10),1),
        'receiver_phone'=>$this->phoneGenerator(),
        'invoice_number'=>$this->randname(10,2),
        'member_id'=>User::inRandomOrder()->first()->id,
      ]);
    }
    foreach (range(1,rand(10,15)) as $id){
        Order::create([
            'state' => 1,
           'pay_method' => 0,
           'message' =>'adsfas',
            'receiver' => 'asdfasfd',
            'member_id' => User::inRandomOrder()->first()->id,

        ]);
    }
  }






  private function randname($len,$type){
    $charset="abcdefghijaklmopqrstuvwxyz1234567890";
    $result ="";
    //for username passord email
    if ($type ===0){
      foreach (range(1,$len) as $id){
        if ($id===1){
          $result =$result.$charset[rand(0,25)];
        }else
          $result = $result.$charset[rand(0,35)];
      }
    }
    //for realname
    else if ($type ===1){
      foreach (range(1,$len) as $id){
        $result =$result.$charset[rand(0,25)];
      }
    }
    //for all num
    else if ($type===2){
      foreach (range(1,$len) as $id){
        $result =$result.$charset[rand(25,35)];
      }
    }
    return $result;

  }
  private  function phoneGenerator(){
    $phone = "09";
    $phoneArray = ['0','1','2','3','4','5','6','7','8','9'];
    foreach(range(1,8) as $num){
      $phone = $phone.$phoneArray[rand(0,9)];
    }
    return $phone;
  }
}
