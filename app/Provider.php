<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = [
        'name_provider' , 
        'firstSurname_provider', 
        'secondSurname_provider' , 
        'company_provider' , 
        'address_provider' ,  
        'phone_provider' , 
        'email_provider',
        'nit_provider'
    ];

    public function products()
    {
    	return $this->hasMany(App\Product::class);
    }
}
