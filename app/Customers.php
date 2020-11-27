<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    protected $table = 'customers';
	
    protected $fillable = [
        'cedula_client', 
        'name_client' , 
        'firstSurname_client', 
        'secondSurname_client' , 
        'birth_date_client' , 
        'gender_client' , 
        'age_client' , 
        'address_client' , 
        'city_client' , 
        'nationality_client' , 
        'state_client' , 
        'phone_client' , 
        'email_client'

    ];

    public function cerfificates()
    {
    	return $this->hasMany(App\Certificate::class);
    }
}
