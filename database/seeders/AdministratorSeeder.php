<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Luky Purdiono',
                'username' => 'luky.purdiono',
                'nip' => '199403072015021003',
                'pangkat' => 'II.b / Pengatur Muda Tk. I',
                'bidang' => 'Bagian Umum',
                'seksi' => 'Dukungan Teknis',
                'jabatan' => 'Pelaksana Pemeriksa',
                'roles' => 'Admin',
                'password' => Hash::make('admin123')
            ],
            [
                'name' => 'Andlea Yanto Novitasary',
                'username' => 'andlea.yanto',
                'nip' => '199502232016122002',
                'pangkat' => 'II.d / Pengatur Tk. I',
                'bidang' => 'PFPC II',
                'seksi' => 'Seksi Pabean dan Cukai II',
                'jabatan' => 'Pelaksana Pemeriksa',
                'roles' => 'Staff PFPD',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Ardiansyah Aswin Wicaksono',
                'username' => 'ardiansyah.aswin',
                'nip' => '199505082015021004',
                'pangkat' => 'II.b / Pengatur Muda Tk. I',
                'bidang' => 'PFPC II',
                'seksi' => 'Seksi Pabean dan Cukai II',
                'jabatan' => 'Pelaksana Pemeriksa',
                'roles' => 'Staff PFPD',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Auzan Syahdanur',
                'username' => 'auzan.syahdanur',
                'nip' => '199709012018121002',
                'pangkat' => 'II.c / Pengatur',
                'bidang' => 'PFPC II',
                'seksi' => 'Seksi Pabean dan Cukai II',
                'jabatan' => 'Pelaksana Pemeriksa',
                'roles' => 'Staff PFPD',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Latifah Tri Nugraheni',
                'username' => 'latifah.tri',
                'nip' => '199504192015122001',
                'pangkat' => 'II.b / Pengatur Muda Tk. I',
                'bidang' => 'PFPC II',
                'seksi' => 'Seksi Pabean dan Cukai II',
                'jabatan' => 'Pelaksana Pemeriksa',
                'roles' => 'Staff PFPD',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Josua Heru Rajagukguk',
                'username' => 'josua.heru',
                'nip' => '199509092015021001',
                'pangkat' => 'II.b / Pengatur Muda Tk. I',
                'bidang' => 'PFPC II',
                'seksi' => 'Seksi Pabean dan Cukai II',
                'jabatan' => 'Pelaksana Pemeriksa',
                'roles' => 'Staff PFPD',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Margono',
                'username' => 'margono',
                'nip' => '198208122003121003',
                'pangkat' => 'III.a / Penata Muda',
                'bidang' => 'PFPC II',
                'seksi' => 'Seksi Pabean dan Cukai II',
                'jabatan' => 'Pelaksana Pemeriksa',
                'roles' => 'Staff PFPD',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Nadhien Luckyman Pratama',
                'username' => 'nadhien.luckyman',
                'nip' => '199802142019121002',
                'pangkat' => 'II.c / Pengatur',
                'bidang' => 'PFPC II',
                'seksi' => 'Seksi Pabean dan Cukai II',
                'jabatan' => 'Pelaksana Pemeriksa',
                'roles' => 'Staff PFPD',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Ni Putu Dian Utami Dewi',
                'username' => 'dian.utami.001',
                'nip' => '  199512102015122001',
                'pangkat' => 'II.b / Pengatur Muda Tk. I',
                'bidang' => 'PFPC II',
                'seksi' => 'Seksi Pabean dan Cukai II',
                'jabatan' => 'Pelaksana Pemeriksa',
                'roles' => 'Staff PFPD',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Sabar Mangapul Situmorang',
                'username' => 'sabar.mangapul',
                'nip' => '198401082004121002',
                'pangkat' => 'II.d / Pengatur Tk. I',
                'bidang' => 'PFPC II',
                'seksi' => 'Seksi Pabean dan Cukai II',
                'jabatan' => 'Pelaksana Pemeriksa',
                'roles' => 'Staff PFPD',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Farhan Al-hilals Prahaji',
                'username' => 'farhan.al-hilals',
                'nip' => '200003142018121001',
                'pangkat' => 'II.a / Pengatur Muda',
                'bidang' => 'Bagian Umum',
                'seksi' => 'Subbagian Rumah Tangga',
                'jabatan' => 'Pelaksana Pemeriksa',
                'roles' => 'Rumah Tangga',
                'password' => Hash::make('123456')
            ],
            [
                'name' => 'Syarif Husen Ar Radhi Alkaff',
                'username' => 'syarif.husen',
                'nip' => '199301192012101001',
                'pangkat' => 'II.c / Pengatur',
                'bidang' => 'Bagian Umum',
                'seksi' => 'Subbagian Rumah Tangga',
                'jabatan' => 'Pelaksana Pemeriksa',
                'roles' => 'Rumah Tangga',
                'password' => Hash::make('123456')
            ],
            // [
            //     'name' => '',
            //     'username' => '',
            //     'nip' => '',
            //     'pangkat' => '',
            //     'bidang' => '',
            //     'seksi' => '',
            //     'jabatan' => '',
            //     'roles' => '',
            //     'password' => Hash::make('123456')
            // ],
        ]);
    }
}
