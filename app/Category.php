<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_category' , 
        'description_category',
        'condition_category',
    ];


    public function products()
    {
    	return $this->hasMany(App\Product::class);
    }
}
