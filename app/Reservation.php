<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
   
    protected $fillable = [
        'room_id', 
        'title', 
        'start', 
        'end', 
        'color', 
        'customer_id',
        'condition_reservation',
        'borderColor',
        'textColor'

    ];
        
}
