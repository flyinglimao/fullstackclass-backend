<?php

namespace App;

use Awobaz\Compoships\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'state',
        'pay_method',
        'payment',
        'message',
        'ship_information',
        'ship_information',
        'ship_order',
        'products',
        'receiver',
        'receiver_phone',
        'invoice_number',
        'coupon',
        'member_id'
    ];

    public function sale()
    {
        return $this->hasOne(Sale::class);
    }
}
