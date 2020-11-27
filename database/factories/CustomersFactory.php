<?php

use Faker\Generator as Faker;

$factory->define(App\Customers::class, function (Faker $faker) {
    return [
        'cedula_client' => $faker->randomDigit,
        'name_client' => $faker->name,
    	'firstSurname_client' => $faker->lastName,
    	'secondSurname_client' => $faker->firstName,
    	'birth_date_client' => $faker->dateTime($max = 'now'),
    	'gender_client' => $faker->randomElement($array = array ('Femenino','Masculino','No especifica')),
    	'age_client' => $faker->randomDigit,
    	'address_client'=> $faker->address,
    	'city_client'=>$faker->city,
    	'nationality_client'=>$faker->state,
    	'state_client' => $faker->randomElement($array = array ('Soltero(a)','Casado(a)','Union Libre','Viudo(a)')),
    	'phone_client' => $faker->phoneNumber,
        'email_client' => $faker->unique()->safeEmail,
    ];
});
