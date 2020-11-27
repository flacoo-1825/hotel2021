<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class checkbook extends Model
{
    protected $fillable = [
        'customer_id' , 
        'taxe_id',
        'number_checkbooks',
        'faker_number_checkbooks',
        'date_exit_checkbooks',
        'dian_checkbooks',
        'total_checkbooks',
        'state_checkbooks',
    ];
}
