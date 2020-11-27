<?php

use Faker\Generator as Faker;

$factory->define(App\TypeRoom::class, function (Faker $faker) {
    return [
        'name_type_room' => $faker->randomElement($array = array ('Sencilla','Doble','Triple')),
    	'description_type_room' => $faker->randomElement($array = array ('buena','bonita','barata')),
    	'state_type_room' => $faker->randomElement($array = array ('0','1')),
    ];
});
