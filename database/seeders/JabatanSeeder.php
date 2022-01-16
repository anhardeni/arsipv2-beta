<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatan')->insert([
            ['nama_jabatan' => 'Pelaksana Pemeriksa'],
            ['nama_jabatan' => 'PDTT'],
            ['nama_jabatan' => 'PFPD'],
            ['nama_jabatan' => 'Kepala Seksi'],
            ['nama_jabatan' => 'Kepala Kantor'],
        ]);
    }
}
