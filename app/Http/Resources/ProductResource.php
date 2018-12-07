<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Input;

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
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' =>$this->description,
            'author' => $this->author,
            'author_description' => $this->author_description,
            'interpreter' => $this->interpreter,
            'category_id' =>$this->category_id,
            'subcategory_id' =>$this->subcategory_id,
            'publisher' =>$this->publisher,
            'ISBN' =>$this->isbn,
            'list_price' => $this->list_price,
            'sale_price' =>$this->sale_price,
            'stock' =>$this->stock,
            'picture' => asset($this->picture),
            'publish_year' => $this->publish_year
        ];
    }
}
