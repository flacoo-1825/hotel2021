<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class day extends Model
{
    protected $fillable = [
        'type_frozen_day',
        'quantity_day' ,
        'many_hours_day',
        'description_day',
        'price_hour' ,
        'price_day' ,
        'number_bill_day' ,
        'total_day',
        'date_day',
    ];
}
