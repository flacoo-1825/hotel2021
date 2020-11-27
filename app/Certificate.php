<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [

        'client_id',
        'cityOrigin_certificate',
        'temperature_entry_client',
        'temperature_exit_client',
        'number_certificate',
        'cityDestination_certificate', 
        'placabike_certificate',
        'placaCar_certificate', 
        'adults_certificate', 
        'children_certificate',
        'entry_certificate', 
        'exit_certificate', 
        'observation_certificate'

    ];

    public function customer()
    {
    	return $this->hasOne(App\Customers::class);
    }

    public function companions()
    {
    	return $this->hasMany('App\Companion');
    }
}
