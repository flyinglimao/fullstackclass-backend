<?php

namespace App;

use Awobaz\Compoships\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = [
        'name'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class,'product_tag');
    }
}
