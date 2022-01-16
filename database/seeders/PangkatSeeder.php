<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pangkat')->insert([
            ['nama_pangkat' => 'II.a / Pengatur Muda'],
            ['nama_pangkat' => 'II.b / Pengatur Muda Tk. I'],
            ['nama_pangkat' => 'II.c / Pengatur'],
            ['nama_pangkat' => 'II.d / Pengatur Tk. I'],
            ['nama_pangkat' => 'III.a / Penata Muda'],
            ['nama_pangkat' => 'III.b / Penata Muda Tk. I'],
            ['nama_pangkat' => 'III.c / Penata'],
            ['nama_pangkat' => 'III.d / Penata Tk. I'],
            ['nama_pangkat' => 'IV.a / Pembina'],
            ['nama_pangkat' => 'IV.b / Pembina Tk. I'],
            ['nama_pangkat' => 'IV.c / Pembina Utama Muda'],
            ['nama_pangkat' => 'IV.e / Pembina Utama'],
        ]);
    }
}
