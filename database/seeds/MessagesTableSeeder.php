<?php

use Illuminate\Database\Seeder;
use App\Message;
class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::truncate();
        $total = 10;
        $senderArray = ['Marry','Lisa','Alan','Bob','Christine'];
        $titleArray = [
            ['通知',['交易成功','物品售出','會員升級','評價上升']],
            ['警告',['交易失敗','餘額不足','會員停權','評價下降']]
        ];


        foreach (range(1,$total) as $id){
            $title = rand(0,1);
            $message = rand(0,3);
            $sender = rand(0,4);
            Message::create([
                'sender'=>$senderArray[$sender],
                'type'=> $title,
                'title'=> $titleArray[$title][0],
                'message'=>$titleArray[$title][1][$message],
                'member_id'=>$sender
            ]);
        }
    }

}
