<?php

use Faker\Generator as Faker;

$factory->define(App\Companion::class, function (Faker $faker) {
    return [

        'certificate_id' =>  $faker->randomElement($array = array ('1','2','3')),
    	'temperature_entry_acomp' => $faker->randomDigit,
    	'temperature_exit_acomp' => $faker->randomDigit,
    	'cedula_acomp' => $faker->randomDigit,
        'name_acomp' => $faker->name,
    	'firstSurname_acomp' => $faker->lastName,
    	'secondSurname_acomp' => $faker->firstName,
    	'birth_date_acomp' => $faker->dateTime($max = 'now'),
    	
    ];
});
