<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Abonnement::class, function (Faker $faker) {
    return [
        'naam' => 'Basis',
        'aantal_maanden' => $faker->numberBetween(1, 24),
        'prijs' => $faker->numberBetween(10, 100)
    ];
});
