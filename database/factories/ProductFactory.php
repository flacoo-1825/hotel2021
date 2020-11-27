<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        
        'category_id' => $faker->randomElement($array = array ('1','2','3')),
        'provider_id' => $faker->randomElement($array = array ('1','2','3')),
        'name_product' => $faker->name,
    	'img_product' => $faker->randomElement($array = array ('logo.png','logo.png')),
    	'stock_product' => $faker->numberBetween($min = 1000, $max = 9000),
    	'start_product' => $faker->numberBetween($min = 1000, $max = 9000),
    	'buy_product' => $faker->numberBetween($min = 1000, $max = 9000),
    	'sale_product' => $faker->numberBetween($min = 1000, $max = 9000),
    	'condition_product' => $faker->randomElement($array = array ('0','1')),
    ];
});
