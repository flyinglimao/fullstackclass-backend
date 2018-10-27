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
    $total = 10;

    $fake = \Faker\Factory::create('zh_TW');
    foreach (range(1,$total) as $id){
      $price =rand(100,500);
      $num = rand(1,6);
      Order::create([
        'state'=>0,
        'pay_method'=>0,
        'payment_information'=>json_encode([
          '時間'=>now(),
          '總金額'=>$price*$num,
          '編號'=>$this->randname(20,0),
        ]),
        'message'=>$fake->realText(rand(10,15)),
        'ship_method'=>0,
        'ship_information'=>'快樂物流',
        'ship_order'=>'FIFO',
        'products'=>json_encode(['單價'=>$price,'數量'=>$num]),
        'receiver'=>$this->randname(rand(6,10),1),
        'receiver_phone'=>$this->phoneGenerator(),
        'invoice_number'=>$this->randname(10,2),
        'coupon'=>"null",
        'member_id'=>$id
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