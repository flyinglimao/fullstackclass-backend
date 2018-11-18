<?php

namespace App;

use Awobaz\Compoships\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';
    protected $fillable=[
        'name'
    ];

    public function products(){
        return $this->hasMany(Product::class,'category_id','id');
    }


    public function subcategories(){
        return $this->hasMany(Subcategory::class,'category_id','id');
    }
}
