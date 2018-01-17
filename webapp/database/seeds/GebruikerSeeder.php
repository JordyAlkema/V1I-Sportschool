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
        DB::table('gebruikers')->insert([
            'voornaam' => 'John',
            'achternaam' => 'Doe',
            'email' => 'johndoe@example.com',
            'wachtwoord' => Hash::make('Welkom01'),
            'geboortedatum' => \Carbon\Carbon::now()->subYears(21),
            'pasnummer' => '28357877892',
        ]);
    }
}
