<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    
    protected $fillable = [
    	
        'name_link' , 
        'description_link', 
        'state_link'

   ];

    public function workers(){
        return $this->hasMany(Worker::class);
    }   
}