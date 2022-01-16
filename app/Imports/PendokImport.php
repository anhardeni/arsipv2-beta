<?php

namespace App\Imports;

use App\Models\Pendok;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class PendokImport implements ToModel, WithHeadingRow
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Pendok([
            // 'id' => $row['id'],
            'no_pib' => $row['no_pib'],
            'tgl_pib' => $row['tgl_pib'],
            'importir' => $row['importir'],
            'nip_pfpd' => $row['nip_pfpd'],
            'pfpd' => $row['pfpd'],
            'tgl_tt' => $row['tgl_tt'],
            'jalur' => $row['jalur'],
            'nm_terima'  => $row['nm_terima'],
            'batch_id' => $row['batch_id'],
        ]);
    }
}
