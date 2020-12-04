<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicie extends Model
{
    protected $fillable = [
        'name_servicie',
        'description_servicie',
        'price_servicie',
        'condition_servicie',
    ];
}
