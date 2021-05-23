<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = [

        'number_check',
        'end_check',
        'number_ticket',
        'end_ticket', 
        'number_certificate',
        'end_cerficate', 
        'number_reception', 
        'end_reception',
        'number_ext', 
        'end_ext',
        'number_buy',
        'end_buy',
        'number_box',
        'end_box',
    ];
}
