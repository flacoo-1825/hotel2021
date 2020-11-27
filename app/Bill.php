<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
     protected $fillable = [
        'customer_id' , 
        'room_id',
        'worker_id',
        'provider_id',
        'buy_id',
        'sale',
        'certificate_id',
        'taxe_id',
        'number_bill',
        'faker_number_bill',
        'date_entry_bill',
        'date_exit_bill',
        'dian_bill',
        'total_bill',
        'state_bill',
        'class_bill',
        'description_bill'
    ];

    // public function products()
    // {
    // 	return $this->hasMany(App\Product::class);
    // }
}
