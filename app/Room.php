<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [

        'type_room_id',
        'client_id',
        'number',
        'price' ,
        'price_air',
        'number_certificate',
        'frozen' ,
        'number_facture' ,
        'state' ,
        'condition' ,
        'condition_state',

   ];

   public function type_room(){
       return $this->hasOne(Type_room::class);

   }
}
