<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $fillable = [
        'worker_id',
        'number_box',
        'efecty_box',
        'credit_box',
        'buy_box',
        'difference_box',
        'download_box',
        'state_box',
        'description_box',
        'open_efecty_box',
        'efecty_soft_box'
        ];
}
