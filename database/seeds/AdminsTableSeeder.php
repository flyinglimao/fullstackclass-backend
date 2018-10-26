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
        $total = 10;
        //
        Admin::truncate();
        foreach (range(1,$total) as $id){
            Admin::create();
        }

    }
}
