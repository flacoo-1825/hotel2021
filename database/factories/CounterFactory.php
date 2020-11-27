<?php

use Faker\Generator as Faker;

$factory->define(App\Counter::class, function (Faker $faker) {
    return [
        'number_check'=> $faker->numberBetween($min = 1001, $max = 9000),
        'end_check'=> $faker->randomElement($array = array ('-Fact')),
        'number_ticket'=> $faker->numberBetween($min = 1001, $max = 9000),
        'end_ticket'=> $faker->randomElement($array = array ('Fact')),
        'number_certificate'=> $faker->numberBetween($min = 1001, $max = 9000),
        'end_certificate'=> $faker->randomElement($array = array ('-Act')),
        'number_reception'=> $faker->numberBetween($min = 1001, $max = 9000),
        'end_reception'=> $faker->randomElement($array = array ('-Recept')),
        'number_ext'=> $faker->numberBetween($min = 1001, $max = 9000), 
        'end_ext'=> $faker->randomElement($array = array ('-Fact/ext')),
        'number_buy'=> $faker->numberBetween($min = 1001, $max = 9000), 
        'end_buy'=> $faker->randomElement($array = array ('-Comp')),
    ];
});
