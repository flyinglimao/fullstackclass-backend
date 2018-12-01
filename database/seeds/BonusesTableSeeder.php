<?php

use Illuminate\Database\Seeder;
use App\Bonus;
class BonusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Bonus::truncate();
        $messageTitle = ['紅利增加','禮品兌換成功','禮品兌換失敗'];

        $total = 10;
        foreach (range(1,$total) as $id){
            $message = rand(0,2);
            $change = ($message ===0)? rand(5,10):(($message===1)?rand(-15,-5):0);
            Bonus::create([
                'change' => $change,
                'message' => $messageTitle[$message],
                'user_id' => \App\User::inRandomOrder()->first()->id,
                'order_id' => $id
            ]);
        }

    }
}
