<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidang';
    protected $guarded =['created_at','updated_at'];

    public function seksi(){
        return $this->hasMany(Seksi::class,'bidang_id');
    }
}
