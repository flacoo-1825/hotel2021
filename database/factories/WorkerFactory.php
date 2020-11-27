<?php

use Faker\Generator as Faker;

$factory->define(App\Worker::class, function (Faker $faker) {
    return [
        'link_id' => $faker->randomElement($array = array ('2','1')),
    	'cedula_worker' => $faker->randomDigit,
        'name_worker' => $faker->name,
    	'firstSurname_worker' => $faker->lastName,
    	'secondSurname_worker' => $faker->firstName,
    	'birth_date_worker' => $faker->dateTime($max = 'now'),
    	'gender_worker' => $faker->randomElement($array = array ('Femenino','Masculino','No especifica')),
    	'age_worker' => $faker->randomDigit,
        'scholarship_worker' => $faker->randomElement($array = array ('Primaria','Secundaria','Técnico','Profesional','Otro')),
    	'number_children_worker' => $faker->randomDigit,
    	'state_worker' => $faker->randomElement($array = array ('Soltero(a)','Casado(a)','Union Libre','Viudo(a)')),
    	'phone_worker' => $faker->phoneNumber,
        'address_worker'=> $faker->address,
        'email_worker' => $faker->unique()->safeEmail,
        'password_worker' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
    	'condition_worker' => $faker->randomElement($array = array ('0','1')),
    ];
});
