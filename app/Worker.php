<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'link_id',
        'cedula_worker', 
        'name_worker' , 
        'firstSurname_worker', 
        'secondSurname_worker' , 
        'birth_date_worker' , 
        'gender_worker' , 
        'age_worker' , 
        'scholarship_worker'  , 
        'number_children_worker' , 
        'state_worker' , 
        'phone_worker',
        'address_worker' , 
        'email_worker', 
        'password_worker', 
        'condition_worker', 
    ];

 
    public function link(){
        return $this->hasOne(Link::class);
    }
}
