<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bidang')->insert([
            ['nama_bidang' => 'Bagian Umum'],
            ['nama_bidang' => 'Perbendaharaan dan Keberatan'],
            ['nama_bidang' => 'PFPC I'],
            ['nama_bidang' => 'PFPC II'],
            ['nama_bidang' => 'Penindakan dan Penyidikan'],
            ['nama_bidang' => 'Kepatuhan Internal dan Layanan Informasi'],
            ['nama_bidang' => 'Fungsional'],
        ]);
    }
}
