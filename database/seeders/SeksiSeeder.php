<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SeksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seksi')->insert([
            ['nama_seksi' => 'Subbagian Rumah Tangga','bidang_id'=> '1'],
            ['nama_seksi' => 'Subbagian Dukungan Teknis','bidang_id'=> '1'],
            ['nama_seksi' => 'Subbagian Keuangan','bidang_id'=> '1'],
            ['nama_seksi' => 'Seksi Adm. Penerimaan dan Pengembalian','bidang_id'=> '2'],
            ['nama_seksi' => 'Seksi Penagihan','bidang_id'=> '2'],
            ['nama_seksi' => 'Seksi Keberatan dan Banding','bidang_id'=> '2'],
            ['nama_seksi' => 'Seksi Pabean dan Cukai I','bidang_id'=> '3'],
            ['nama_seksi' => 'Seksi Pabean dan Cukai II','bidang_id'=> '3'],
            ['nama_seksi' => 'Seksi Pabean dan Cukai III','bidang_id'=> '3'],
            ['nama_seksi' => 'Seksi Fasilitas Kepabeanan I','bidang_id'=> '3'],
            ['nama_seksi' => 'Seksi Fasilitas Kepabeanan II','bidang_id'=> '3'],
            ['nama_seksi' => 'Seksi Adm. Manifest I','bidang_id'=> '4'],
            ['nama_seksi' => 'Seksi Adm. Manifest II','bidang_id'=> '4'],
            ['nama_seksi' => 'Seksi Intelijen I','bidang_id'=> '5'],
            ['nama_seksi' => 'Seksi Patroli dan Operasi I','bidang_id'=> '5'],
            ['nama_seksi' => 'Seksi Patroli dan Operasi II','bidang_id'=> '5'],
            ['nama_seksi' => 'Seksi Penyidikan dan BHP','bidang_id'=> '5'],
            ['nama_seksi' => 'Seksi Sarana Operasi','bidang_id'=> '5'],
            ['nama_seksi' => 'Seksi Kepatuhan Pelaksanaan Tugas Pelayanan','bidang_id'=> '6'],
            ['nama_seksi' => 'Seksi Pelaksanaan Tugas Pengawasan','bidang_id'=> '6'],
            ['nama_seksi' => 'Seksi Pelaksanaan Tugas Administrasi','bidang_id'=> '6'],
            ['nama_seksi' => 'Seksi Pelaksanaan Tugas Bimbingan Kepatuhan','bidang_id'=> '6'],
            ['nama_seksi' => 'Seksi Layanan Informasi','bidang_id'=> '6'],
        ]);
    }
}
