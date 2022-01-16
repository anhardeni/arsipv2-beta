<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Builder;

class Pendok extends Model
{
    use HasFactory;
    use HasStatus;
    
    protected $table = 'pendok';
    protected $guarded = ['created_at','updated_at'];
    
    public function batching(){
        return $this->belongsTo(Batching::class, 'batch_id');
    }

    public function peminjaman(){
        return $this->belongsTo(Peminjaman::class, 'peminjaman_id');
    }

    public function scopeByNomorTanggal(Builder $query, $no_pib, $tgl_pib){
        return $query->where('no_pib', $no_pib)->where('tgl_pib', $tgl_pib);
    }

}
