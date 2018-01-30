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
        /**
         * Locaties
         */

        factory(\App\Models\Locatie::class)->create([
            'naam' => 'Utrecht',
            'stad' => 'Utrecht',
            'straat' => 'straat',
            'huisnummer' => '15A',
        ]);

        factory(\App\Models\Locatie::class)->create([
            'naam' => 'Den Haag',
            'stad' => 'Den Haag',
            'straat' => 'straat',
            'huisnummer' => '3B',
        ]);

        factory(\App\Models\Locatie::class)->create([
            'naam' => 'Rotterdam',
            'stad' => 'Rotterdam',
            'straat' => 'straat',
            'huisnummer' => '318',
        ]);

        factory(\App\Models\Locatie::class)->create([
            'naam' => 'Amersfoort',
            'stad' => 'Amersfoort',
            'straat' => 'straat',
            'huisnummer' => '16',
        ]);

        factory(\App\Models\Locatie::class)->create([
            'naam' => 'Lelystad',
            'stad' => 'Lelystad',
            'straat' => 'straat',
            'huisnummer' => '115',
        ]);

        /**
         * Automaattypes
         */

        factory(\App\Models\Automaattype::class)->create([
            'naam' => 'Loopband'
        ]);

        factory(\App\Models\Automaattype::class)->create([
            'naam' => 'Fiets'
        ]);

        factory(\App\Models\Automaattype::class)->create([
            'naam' => 'Dumbells'
        ]);

        /**
         *  Transactietypes
         */

        factory(\App\Models\Transactietype::class)->create([
            'naam' => 'Afschrijving',
        ]);

        factory(\App\Models\Transactietype::class)->create([
            'naam' => 'Bijschrijving',
        ]);

        /**
         * Rollen
         */

        factory(\App\Models\Rol::class)->create([
            'naam' => 'Gebruiker',
            'beheerder' => false,
        ]);

        factory(\App\Models\Rol::class)->create([
            'naam' => 'Medewerker',
            'beheerder' => true,
        ]);

        /**
         * Abonnementen
         */

        factory(\App\Models\Abonnement::class)->create([
            'naam' => 'Basis',
            'aantal_maanden' => 3,
            'prijs' => 50,
        ]);

        factory(\App\Models\Abonnement::class)->create([
            'naam' => 'Basis',
            'aantal_maanden' => 6,
            'prijs' => 90,
        ]);

        factory(\App\Models\Abonnement::class)->create([
            'naam' => 'Basis',
            'aantal_maanden' => 12,
            'prijs' => 170,
        ]);

        factory(\App\Models\Abonnement::class)->create([
            'naam' => 'Basis',
            'aantal_maanden' => 24,
            'prijs' => 300,
        ]);

        /**
         * Anders
         */

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
