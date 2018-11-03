<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $total = 10;

        foreach (range(1,$total) as $id){

            User::create([
                'username'=>$this->randname(rand(4,14),0),
                'password'=>$this->randname(rand(7,13),0),
                'realname'=>$this->randname(rand(4,8), 1),
                'email'=>$this->randname(rand(7,13),0)."@gmail.com",
                'level'=>rand(1,9),
                'phone'=>$this->phoneGenerator(),
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
            $result ="";
            foreach (range(1,$len) as $id){
                $result =$result.$charset[rand(0,25)];
            }
        }
        return $result;

    }
    private  function phoneGenerator(){
        $phone = "09";
        $phoneArray = ['0','1','2','3','4','5','6','7','8','9'];
        foreach(range(1,8) as $num){
            $phone = $phone.$phoneArray[rand(0,9)];
            if ($num ===2||$num ===5)
                $phone = $phone."-";
        }
        return $phone;
    }
}
