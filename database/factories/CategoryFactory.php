<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name_category' => $faker->randomElement($array = array ('Aseo','Bebidas Calientes','Comidas Rápidas')),
    	'description_category' => $faker->text($maxNbChars = 100),
    	'condition_category' => $faker->randomElement($array = array ('0','1')),
    ];
});
