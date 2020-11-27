<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class companion extends Model
{   
    protected $fillable = [

        'certificate_id',
        'temperature_entry_acomp',
        'temperature_exit_acomp',
        'cedula_acomp', 
        'name_acomp',
        'firstSurname_acomp', 
        'secondSurname_acomp', 
        'birth_date_acomp'

    ];

    public function cerfiticate()
    {
        return $this->belongsTo('App\Certificate');
    }
 
}
