<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Subcategory;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cate_array=[
            '文學叢書'=>['靈異奇幻','心理勵志','醫療保健','懸疑推理'],
            '考試用書'=>['小學','國中','高中','大學','研究所','國家考試'],
            '童話繪本'=>['著色本','有聲書','益智圖卡','兒童文學'],
            '語言學習'=>['日文','英文','德文','法文'],
            '漫畫'=>['戀愛','武俠','科幻','靈異','搞笑'],
            '小說'=>['戀愛','武俠','科幻','靈異','搞笑'],
            '雜誌'=>['婚紗雜誌','時尚穿搭','流行彩妝','汽車機車','男性時尚','女性時尚']
        ];
        Category::truncate();
        Subcategory::truncate();
        $id = 0;
        foreach ($cate_array as $category=>$subcate_array){
            $id+=1;
            Category::create([
                'name'=>$category
            ]);
            foreach ($subcate_array as $sub_id=>$subcategory){
                Subcategory::create([
                   'name'=>$subcategory,
                   'category_id'=>$id,
                   'subcategory_id'=> $sub_id+1,
                ]);
            }
        }

    }
}
