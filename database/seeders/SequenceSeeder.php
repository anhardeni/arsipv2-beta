<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SequenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sequence')->insert([
            'nama' => 'batch',
            'tahun' => '2021',
            'sequence' => '493',
        ]);
    }
}
