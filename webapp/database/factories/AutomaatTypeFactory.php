<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Automaattype::class, function (Faker $faker) {
    return [
        //
        'naam' => $faker->word
    ];
});
