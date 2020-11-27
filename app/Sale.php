<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    protected $fillable = [
        'bill_id' , 
        'checkbook_id', 
        'product_id' ,
        'addition_id' ,  
        'taxe_id' , 
        'number_bill_sales' ,  
        'dian_bill' , 
        'total_sales',
        'state_bill',
        'price_unit_sales',
        'quantity_sales',
        'description_sales',

    ];

    // public function products()
    // {
    // 	return $this->hasMany(App\Product::class);
    // }
}
