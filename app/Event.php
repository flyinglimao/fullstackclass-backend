<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "events";
    protected $fillable= [
        'url',
        'title',
        'description',
        'hero_image',
        'side_image',
        'filter',
        'price_operation',
        'time_interval',
        'frequency_limit',
        'priority'

    ];
}
