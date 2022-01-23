<?php

namespace App\Imports;

use App\Models\Pib;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
HeadingRowFormatter::default('none');

class Bc25Import implements ToModel , WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   
    public function model(array $row)
    {
        return new Pib([
            'no_pib' => $row['No. PIB'],
            'tgl_pib' => $row['Tgl. PIB'],
            'importir' => $row['Nama Importir'],
            'nip_pfpd' => $row['NIP PFPD'],
            'pfpd' => $row['PFPD'],
            'tgl_tt' => $row['Waktu Terima'],
            'jalur' => $row['Jalur'],
            'nm_terima'  => $row['Petugas']
        ]);
    }

    public function rules(): array
    {
        return[
            'Waktu Terima' => 'min:3',
            'Petugas' => 'min:3'
        ];
    }
}
