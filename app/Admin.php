<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = 'admins';
    protected $fillable =[
        'username',
        'password',
        'permissions',
        'display_name',
        'email',
        'phone',
    ];
}
