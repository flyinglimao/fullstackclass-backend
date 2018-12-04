<?php

namespace App;

use Awobaz\Compoships\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table='subcategories';
    protected $fillable=[
        'name',
        'category_id',
        'subcategory_id'
    ];

    public function products(){
        return $this->hasMany(Product::class,
            ['category_id','subcategory_id'],
            ['category_id','subcategory_id']);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
