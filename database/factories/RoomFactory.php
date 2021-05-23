<?php

use Faker\Generator as Faker;

$factory->define(App\Room::class, function (Faker $faker) {
    return [
        'client_id' => $faker->randomElement($array = array (NULL,NULL)), 
        'type_room_id' => $faker->randomElement($array = array ('1','2','3')),
    	'number' => $faker->numberBetween($min = 201, $max = 311),
    	'price' => $faker->numberBetween($min = 1000, $max = 9000),
    	'price_air' => $faker->numberBetween($min = 1000, $max = 9000),
    	'frozen' => $faker->randomElement($array = array ('Ventilador','Aire Acondicionado','Aire Acondicionado---Ventilador')),
    	'number_facture' => $faker->numberBetween($min = 1000, $max = 9000),
    	'state' => $faker->randomElement($array = array ('Disponible','Ocupada')),
    	'condition_state' => $faker->randomElement($array = array ('R','')),
    	'condition' => $faker->randomElement($array = array ('0','1')),
    ];
});
