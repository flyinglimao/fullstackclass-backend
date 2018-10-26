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
        $total = 10;
        Event::truncate();
        foreach (range(1,$total) as $id){
            Event::create();
        }

    }
}
