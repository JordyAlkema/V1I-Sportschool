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

        $this->call([
            GebruikerSeeder::class
        ]);
    }
}
