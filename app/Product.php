<?php

namespace App;

use Awobaz\Compoships\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable=[
        'title',
        'subtitle',
        'description',
        'type',
        'author',
        'publisher',
        'isbn',
        'category_id',
        'subcategory_id',
        'tags',
        'list_price',
        'sale_price',
        'stock',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,
            ['category_id','subcategory_id'],
            ['category_id','subcategory_id']);
    }

}
