<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AdministratorSeeder::class);
        $this->call(BidangSeeder::class);
        $this->call(PfpdSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(PangkatSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(SeksiSeeder::class);
        $this->call(BatchSeeder::class);
        $this->call(SequenceSeeder::class);
    }
}
