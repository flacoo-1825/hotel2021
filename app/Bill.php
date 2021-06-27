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
        'number_certificate',
        'faker_number_bill',
        'date_entry_bill',
        'date_exit_bill',
        'dian_bill',
        'total_additionals',
        'total_days',
        'total_products',
        'total_bill',
        'state_bill',
        'class_bill',
        'pay_bill',
        'description_bill',
        'name_type_room',
        'date_pay_bill'
    ];

    // public function products()
    // {
    // 	return $this->hasMany(App\Product::class);
    // }
}
