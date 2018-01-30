<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Transactietype::class)->create([
            'naam' => 'Afschrijving',
        ]);

        factory(\App\Models\Transactietype::class)->create([
            'naam' => 'Bijschrijving',
        ]);

        factory(\App\Models\Rol::class)->create([
            'naam' => 'Gebruiker',
            'beheerder' => false,
        ]);

        factory(\App\Models\Rol::class)->create([
            'naam' => 'Medewerker',
            'beheerder' => true,
        ]);

        factory(\App\Models\Automaat::class)->create([
            'api_key' => 'Hlv80ShcFEjhrAHLd4ylcacHg4iWnbjwgF6MdAYAB1t9nUcjScHkxDl'
        ]);

        factory(\App\Models\Gebruiker::class)->create([
            'voornaam' => 'Jason',
            'achternaam' => 'test',
            'pasnummer' => '160.99.145.94'
        ]);

        $this->call([
            GebruikerSeeder::class
        ]);
    }
}
