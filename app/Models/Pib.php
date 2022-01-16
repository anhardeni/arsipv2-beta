<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pib extends Model
{
    protected $table = "imporpib";
    protected $key = 'no_pib';
    protected $fillable = ['no_pib','tgl_pib','importir','nip_pfpd','pfpd','tgl_tt','jam_tt','jalur','nm_terima'];
}
