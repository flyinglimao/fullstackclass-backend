<?php

use App\Category;
use Illuminate\Database\Seeder;
use App\Product;
use App\Subcategory;
use App\ProductTag;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::truncate();
        ProductTag::truncate();
        $total = 60;
        $publisherArray = ['紅樹林出版','九章出版社','天下文化','天下雜誌','雄獅圖書','幼獅文化','卓著出版社'];
        $bookArray = ['唐吉軻德','雙城記','童軍警探','紅樓夢','麥田捕手','黑美人','玫瑰之名','天地一沙鷗','天使與魔鬼','安妮日記'];
        $InterpreterArray = ['呂相儒','林光 (當代翻譯家)','黎烈文','賴明珠','林曙光 (作家)',
            '劉其偉','劉墉 (作家、畫家)','李昂 (作家)','劉慕沙'];
        $fake = \Faker\Factory::create('zh_TW');
        foreach (range(1,$total) as $id){
            $price = rand(300,1200);
            $category_id = Category::inRandomOrder()->first()->id;
            $subcategory_id=Subcategory::inRandomOrder()->where('category_id',$category_id)->first()->subcategory_id;
            $product = Product::create([
                'title' => $bookArray[($id-1)%10],
                'subtitle' => $fake->realText(rand(10,15)),
                'description' => $fake->realText(rand(10,15)),
                'type' => 0,
                'author' => "作者".($id-1)%10,
                'publisher' => $publisherArray[rand(0,6)],
                'publish_year'=>rand(1,2020),
                'isbn'=>$this->randISBN(),
                'category_id' =>$category_id,
                'subcategory_id'=>$subcategory_id,
                'author_description' =>$fake->realText(rand(10,15)),
                'interpreter' => $InterpreterArray[rand(0,8)],
                'list_price' => $price,
                'sale_price' => floor($price*rand(60,100)/100),
                'stock' => rand(0,10),
            ]);
            foreach (range(1,3) as $id){
                $product->tags()->attach(rand(1,8));
            }
        }
    }
    public function randISBN(){
        $number = "0123456789";
        $total = 13;
        $result = "";
        foreach (range(1,$total) as $id){
            if ($id ===0){
                $result = $result.$number[rand(1,9)];
            }else
                $result = $result.$number[rand(0,9)];
        }
        return $result;
    }
}
