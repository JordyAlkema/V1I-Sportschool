<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Hash;

class GebruikerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Gebruiker::class, 12)
            ->create()
            ->each(function ($gebruiker){
                factory(\App\Models\Activiteiten::class, 4)->create(
                    [
                        'user_id' => $gebruiker['id']
                    ]
                );
            });
    }
}
