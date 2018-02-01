<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Automaat::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        //
        'naam' => $name,
        'api_key' => str_random(55),
        'bedrag_per_minuut' => $faker->randomFloat(4, 0.005, 0.015),
        'kcal_per_minuut' => $faker->numberBetween(1,4),
        'automaat_type_id' => $faker->numberBetween(1, 3),
        'locatie_id' => $faker->numberBetween(1, 5)
    ];
});
