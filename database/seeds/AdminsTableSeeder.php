<?php

use Illuminate\Database\Seeder;
use App\Admin;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminTable =['黃千綾','吳宇宸','謝維毅','洪偉捷'];

        //
        Admin::truncate();
        foreach ($adminTable as $id=>$username){
            Admin::create([
                'username'=>$username,
                'password'=>'manager123',
                'permissions'=>json_encode(['權限'=>"等級10"]),
                'display_name'=>'Manager'.$id,
                'email'=>$this->randname(rand(8,12),0)."@gmail.com",
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
        }
        return $phone;
    }
}

