<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Transactie::class, function (Faker $faker) {

    $transactieType_id = $faker->randomElement([1, 2]);
    $bedrag = $faker->numberBetween(1, 10);

    if($transactieType_id == 1){
        $bedrag = -$bedrag;
    }

    $user = factory(\App\Models\Gebruiker::class)->create();

    return [
        //
        'user_id' => $user->id,
        'transactieType_id' => $transactieType_id,
        'bedrag' => $bedrag,
        'datum' => \Carbon\Carbon::now(),
        'activiteit_id' => function() use ($user){
            return factory(\App\Models\Activiteiten::class)->create([
                'user_id' => $user->id
            ])->id;
        },
    ];
});
