<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
        'tags',
        'list_price',
        'sale_price',
        'stock',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
