<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGudang extends Model
{
    use HasFactory;
    protected $table = 'data_gudang';
    protected $guarded =['created_at','updated_at'];

    public function rak(){
        return $this->hasMany(Rak::class,'gudang_id');
    }
}
