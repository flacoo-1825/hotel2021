<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{

    protected $fillable = [
       
        'name_additional',
        'description_additional',
        'price_additional', 
        'condition_additional'
    ];
    
}
