<?php

use Illuminate\Database\Seeder;
use App\Sale;
class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sale::truncate();
        $total = 10;
        foreach (range(1,$total) as $id){
            Sale::create();
        }

    }
}
