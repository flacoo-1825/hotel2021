<?php

use Faker\Generator as Faker;

$factory->define(App\Link::class, function (Faker $faker) {
    return [
        'name_link' => $faker->randomElement($array = array ('Multiservicios','Cootrabajadores','Sindicato',
        	'Venezuela Libre')),

    	'description_link' => $faker->randomElement($array = array ('Contrato fijo','Temporal','prestación de servicios')),

    	'state_link' => $faker->randomElement($array = array ('0','1')),
    ];
});
