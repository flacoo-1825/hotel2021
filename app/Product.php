<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

        'category_id',
        'provider_id',
        'name_product',
        'img_product',
        'stock_product',
        'start_product',
        'buy_product',
        'sale_product',
        'condition_product',

    ];

    public function category()
    {
    	return $this->belongsTo(App\Category::class);
    }

    public function provider()
    {
    	return $this->belongsTo(App\Provider::class);
    }
}
