<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Rol::class, function (Faker $faker) {
    return [
        'naam' => $faker->word,
        'beheerder' => $faker->boolean(10)
    ];
});
