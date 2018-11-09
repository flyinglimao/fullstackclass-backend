<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cate_array=['國文','英文','數學','自然','社會'];
        Category::truncate();
        $total =5;
        foreach (range(1,$total) as $id){
            Category::create([
                'name'=>$cate_array[$id-1]
            ]);
        }

    }
}
