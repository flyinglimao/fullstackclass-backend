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
        Product::truncate();

        $total = 10;
        $categoryArray = ['哲學','宗教','自然科學','應用科學','社會科學','中國史地','世界史地','語文','美術'];
        $publisherArray = ['紅樹林出版','九章出版社','天下文化','天下雜誌','雄獅圖書','幼獅文化','卓著出版社'];
        $bookArray = ['唐吉軻德','雙城記','童軍警探','紅樓夢','麥田捕手','黑美人','玫瑰之名','天地一沙鷗','天使與魔鬼','安妮日記'];
        $fake = \Faker\Factory::create('zh_TW');
        foreach (range(1,$total) as $id){
            $price = rand(300,1200);
            Product::create([
                'title' => $bookArray[$id-1],
                'subtitle' => $fake->realText(rand(10,15)),
                'description' => $fake->realText(rand(10,15)),
                'type' => 0,
                'author' => "作者".$id,
                'publisher' => $publisherArray[rand(0,6)],
                'isbn'=>$this->randISBN(),
                'category' => $categoryArray[rand(0,8)],
                'tags' => "null",
                'list_price' => $price,
                'sale_price' => floor($price*rand(60,100)/100),
                'stock' => rand(0,10),
            ]);
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
