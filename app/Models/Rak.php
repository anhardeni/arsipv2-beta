<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;
    protected $table = 'rak';
    protected $guarded = ['created_at','updated_at'];

    public function data_gudang(){
        return $this->belongsTo(DataGudang::class,'gudang_id');
    }

}
