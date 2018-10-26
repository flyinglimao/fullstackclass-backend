<?php

use Illuminate\Database\Seeder;
use App\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create();
        $total = 5;
        foreach (range(1,$total) as $id){
            Product::create();
        }
    }
}
