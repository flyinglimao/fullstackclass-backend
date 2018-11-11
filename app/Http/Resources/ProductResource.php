<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
//下面這一行可以指定要不要用data將資料包起來，空字串代表不要包起來
//    public static $wrap = '';
//也可以在有使用到resource的地方先用resource_name::withoutWrapping(); 也有相同的笑過
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' =>$this->title,
            'description' =>$this->description,
            'category' =>$this->category->name,
            'publisher' =>$this->publisher,
            'ISBN' =>$this->isbn,
            'sale_price' =>$this->sale_price,
            'stock' =>$this->stock,
        ];
    }
}
