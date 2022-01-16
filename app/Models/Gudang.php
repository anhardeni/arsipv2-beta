<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasStatus;


class Gudang extends Model
{
    use HasFactory;
    use HasStatus;
    protected $table = 'gudang';
    protected $guarded = ['created_at','updated_at'];
    
    public function kardus(){
        return $this->belongsTo(Kardus::class, 'kardus_id');
    }

    public function rak(){
        return $this->belongsTo(Rak::class);
    }

    public function gudang(){
        return $this->belongsTo(DataGudang::class,'data_gudang_id');
    }

}
