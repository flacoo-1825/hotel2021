<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    protected $fillable = [
    'number_bill',
    'product_id',
    'provider_id',
    'taxe_id',
    'number_bill_buy',
    'class_pay',
    'date_pay',
    'dian_bill',
    'quantity_buy',
    'description_buy',
    'price_unit_buy',
    'total_buy',
    'state_buy',
    ]; 
}
