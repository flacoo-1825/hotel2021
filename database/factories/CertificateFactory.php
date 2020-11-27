<?php

use Faker\Generator as Faker;

$factory->define(App\Certificate::class, function (Faker $faker) {
    return [

        'client_id' => $faker->randomElement($array = array ('1','2','3')),
        'temperature_entry_client' =>$faker->randomElement($array = array ('36','35','40')),
        'temperature_exit_client' =>$faker->randomElement($array = array ('32','31')),
    	'number_certificate' => $faker->randomElement($array = array ('1','2','3')),
        'cityOrigin_certificate' => $faker->randomElement($array = array ('ciudad 1','ciudad 2','ciudad3')),
        'cityDestination_certificate' => $faker->randomElement($array = array ('ciudad 1','ciudad 2','ciudad3')),
        'placabike_certificate' => $faker->name,
        'placaCar_certificate' => $faker->name,
    	'adults_certificate' => $faker->numberBetween($min = 1, $max = 10),
        'children_certificate' => $faker->numberBetween($min = 0, $max = 5),
        'entry_certificate' => $faker->dateTime($max = 'now'),
        'exit_certificate' => $faker->dateTime($max = 'now'),
    	'observation_certificate' => $faker->randomElement($array = array ('Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse accusantium ullam officia rem, 
        eum voluptatum incidunt laboriosam tenetur ipsa corrupti voluptate ut omnis provident itaque
         fugit maxime, odit modi quibusdam!Quia, dolorum molestias ut quisquam facere eos, enim id repellat
         , aperiam ex voluptates harum nihil beatae quod amet.','Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse accusantium ullam officia rem, 
         eum voluptatum incidunt laboriosam tenetur ipsa corrupti voluptate ut omnis provident itaque
          fugit maxime, odit modi quibusdam!Quia, dolorum molestias ut quisquam facere eos, enim id repellat
          , aperiam ex voluptates harum nihil beatae quod amet.')),
    ];
});
