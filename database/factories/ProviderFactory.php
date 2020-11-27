<?php

use Faker\Generator as Faker;

$factory->define(App\Provider::class, function (Faker $faker) {
    return [
        'company_provider' => $faker->randomElement($array = array ('Colombina','Bavaria','Coca-Cola','Postobon')),
        'name_provider' => $faker->name,
        'firstSurname_provider' => $faker->lastName,
        'secondSurname_provider' => $faker->firstName,
    	'address_provider'=> $faker->address,
    	// 'city_provider'=>$faker->city,
    	'phone_provider' => $faker->phoneNumber,
        'email_provider' => $faker->safeEmail,
        'condition_provider' => $faker->randomElement($array = array ('0','1')),
    ];
});
