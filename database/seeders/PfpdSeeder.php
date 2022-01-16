<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PfpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pfpd')->insert([
            ['pfpd' => 'ABDUL ROZAK', 'nip_pfpd' => '197912172000121002'],
            ['pfpd' => 'AMIRUDIN', 'nip_pfpd' => '197602271997031001'],
            ['pfpd' => 'ANDI PRABAWA', 'nip_pfpd' => '197602271997031001'],
            ['pfpd' => 'ARIE KUSUMA', 'nip_pfpd' => '197903212000121001'],
            ['pfpd' => 'ARIF FAKBIYANTO', 'nip_pfpd' => '197703092000011001'],
            ['pfpd' => 'BAGUS HARIADI', 'nip_pfpd' => '197704101999031004'],
            ['pfpd' => 'BAMBANG TRI UTOMO', 'nip_pfpd' => '197812032000011001'],
            ['pfpd' => 'DWI ARYA PRAJA', 'nip_pfpd' => '197812182000121002'],
            ['pfpd' => 'EDIE PURWANTO', 'nip_pfpd' => '197601111997031001'],
            ['pfpd' => 'FRANSISKUS TEDDY', 'nip_pfpd' => '197804162000011001'],
            ['pfpd' => 'HARTONO', 'nip_pfpd' => '197604281996021002 '],
            ['pfpd' => 'KOMARA MIJAYA', 'nip_pfpd' => '197206111992121001 '],
            ['pfpd' => 'KURNIA ADRI KUSUMA', 'nip_pfpd' => '197605241996031001'],
            ['pfpd' => 'MAULANA ICHSAN', 'nip_pfpd' => '197503221995031002'],
            ['pfpd' => 'MOHAMMAD ANHAR DENI PURNAMA', 'nip_pfpd' => '197403141995031001'],
            ['pfpd' => 'MUHADI WIBOWO', 'nip_pfpd' => '198101182002121001'],
            ['pfpd' => 'MUHAMAD ROHMAT', 'nip_pfpd' => '197206111993021002'],
            ['pfpd' => 'MUSLIH EFENDI', 'nip_pfpd' => '197603221999031002'],
            ['pfpd' => 'NASRULLAH', 'nip_pfpd' => '197605191997031004'],
            ['pfpd' => 'RAHMAT SARJITO', 'nip_pfpd' => '198010282001121001'],
            ['pfpd' => 'ROMMY HERYADI', 'nip_pfpd' => '198105082002121002'],
            ['pfpd' => 'SAFRUDIN', 'nip_pfpd' => '197606261999031004'],
            ['pfpd' => 'SOLAKHUDDIN KHUMAIDI', 'nip_pfpd' => '197902092000121001'],
            ['pfpd' => 'SOLIHIN', 'nip_pfpd' => '197501291997031001'],
            ['pfpd' => 'SUBHAN KHAERI', 'nip_pfpd' => '197608161997031001'],
            ['pfpd' => 'SUDINARTO', 'nip_pfpd' => '197407161995031001'],
            ['pfpd' => 'SUGENG HARYADI', 'nip_pfpd' => '197509291996021003'],
            ['pfpd' => 'SUGITO', 'nip_pfpd' => '197609061999031002'],
            ['pfpd' => 'SULISTYA NUGRAHA', 'nip_pfpd' => '97308101993011001'],
            ['pfpd' => 'SUTRISNO', 'nip_pfpd' => '197807022000121001'],
            ['pfpd' => 'TEDY HILMAWAN', 'nip_pfpd' => '197912282000121001'],
            ['pfpd' => 'V. ROMI HARYANTO SARUMAHA', 'nip_pfpd' => '197703061997031002'],
            ['pfpd' => 'WAWAN RIDWAN', 'nip_pfpd' => '197612181999031001'],
            ['pfpd' => 'YUDI AMIRULLAH', 'nip_pfpd' => '197809182000011001'],
        ]);
    }
}
