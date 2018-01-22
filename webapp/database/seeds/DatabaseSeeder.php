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

        $this->call([
            GebruikerSeeder::class
        ]);
    }
}
