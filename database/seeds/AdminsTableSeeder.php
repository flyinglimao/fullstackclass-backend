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
        $total = 3;
//        $adminTable =['黃千玲','吳宇宸','謝維毅','洪偉捷'];

        //
        Admin::truncate();
        foreach (range(1,$total) as $id){
            Admin::create();
        }

    }
}
