<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table = "bonuses";
    protected $fillable = [
        'change',
        'message',
        'member_id',
        'order_id'
    ];
}
