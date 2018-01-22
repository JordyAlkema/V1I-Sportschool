<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Locatie::class, function (Faker $faker) {
    return [
        'naam' => $faker->word,
        'stad' => $faker->city,
        'straat' => $faker->streetName,
        'huisnummer' => $faker->numberBetween(0, 200),
    ];
});
