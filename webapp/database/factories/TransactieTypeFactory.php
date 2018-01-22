<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Transactietype::class, function (Faker $faker) {
    return [
        'naam' => $faker->word
    ];
});
