<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeRoom extends Model
{
    protected $fillable = [
    	
         'name_type_room' , 
         'description_type_room', 
         'state_type_room'

    ];
}
