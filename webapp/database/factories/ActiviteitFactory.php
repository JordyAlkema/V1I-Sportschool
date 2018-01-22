<?php

use Faker\Generator as Faker;
use Carbon\Carbon as Carbon;

$factory->define(\App\Models\Activiteiten::class, function (Faker $faker) {
    $beginDatum = Carbon::createFromTimeStamp($faker->dateTimeBetween('-30 days', '+30 days')->getTimestamp());
    $eindDatum = Carbon::createFromFormat('Y-m-d H:i:s', $beginDatum)->addMinutes($faker->numberBetween(0, 90));

    return [
        'user_id' => function(){
            return factory(\App\Models\Gebruiker::class)->create()->id;
        },
        'automaat_id' => function(){
            return factory(\App\Models\Automaat::class)->create()->id;
        },
        'begin_datum' => $beginDatum,
        'eind_datum' => $eindDatum
    ];
});
