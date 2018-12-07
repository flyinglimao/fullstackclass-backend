<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;

class Message extends Model
{
    //
    use Compoships;

    protected $table = 'messages';
    protected $fillable = [
        'sender_id',
        'type',
        'title',
        'message',
        'receiver_id',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id','id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id','id');
    }
}
