<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Automaat::class, function (Faker $faker) {
    $name = $faker->word;
    return [
        //
        'naam' => $name,
        'api_key' => str_random(55),
        'bedrag_per_minuut' => $faker->randomFloat(2, 0, 1),
        'kcal_per_minuut' => $faker->numberBetween(1,4),
        'automaat_type_id' => function() use ($name){
            return factory(\App\Models\Automaattype::class)->create([
                'naam' => $name
            ]);
        },
        'locatie_id' => function(){
            return factory(\App\Models\Locatie::class)->create()['id'];
        },
    ];
});
