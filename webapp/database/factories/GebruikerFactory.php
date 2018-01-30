<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Gebruiker::class, function (Faker $faker) {
    $rol = $faker->randomElement([1,2]);

    if($rol == 2){
        $locatie =  $faker->numberBetween(1, 5);
    }else{
        $locatie = null;
    }

    return [
        'voornaam' => $faker->firstName,
        'tussenvoegsel' => '',
        'achternaam' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'rol_id' => $rol,
        'wachtwoord' => '$2y$10$ojDeHtKtTNG5wYVreio9Y.q3kaCfA6CWTaslJSm3.QSKNP7loN8mG', // secret
        'geboortedatum' => $faker->date(),
        'pasnummer' => $faker->numberBetween(10000000000, 99999999999),
        'remember_token' => str_random(10),
        'locatie_id' => $locatie,
    ];
});
