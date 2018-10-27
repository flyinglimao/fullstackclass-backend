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
        'category',
        'tags',
        'list_price',
        'sale_price',
        'stock',
    ];
}
