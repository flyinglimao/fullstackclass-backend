<?php

namespace App;

use Awobaz\Compoships\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = ['change','products_id','order_id','message'];

    public function product()
    {
        return $this->belongsTo(Product::class,'products_id','id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
