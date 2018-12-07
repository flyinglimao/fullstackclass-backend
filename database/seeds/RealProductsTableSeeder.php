<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Product;
use App\Subcategory;

class RealProductsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Product::truncate();
    
  }
}
