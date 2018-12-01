<?php

use Illuminate\Database\Seeder;
use App\Event;
class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = 5;
        $eventTable=[
            '大一新鮮人主題書展',
            '性別齊視不歧視--性別平等教育書展',
            '遠菸毒､好健康--健康宣導書展',
            '閱讀，美的可能—美感教育書展',
            '臺灣當代旅行文學書展'
        ];
        Event::truncate();
        foreach (range(1,$total) as $id){
            $day = now()->addDay(rand(15,25));
            Event::create([
                'url'=>"http://www.google.com",
                'title'=>$eventTable[$id-1],
                'description'=>"裡面的書都很好看",
                'hero_image'=>"null",
                'side_image'=>"null",
                'filter'=>json_encode(['keyword'=>"null"]),
                'price_operation'=>"null",
                'time_interval'=>json_encode(['start'=>$day,'end'=>$day->addDay(10)]),
                'frequency_limit'=>0,
                'priority'=>0
            ]);
        }

    }
}
