<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;
class Bonus extends Model
{
    use Compoships;
    protected $table = "bonuses";
    protected $fillable = [
        'change',
        'message',
        'user_id',
        'order_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
