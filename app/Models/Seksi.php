<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seksi extends Model
{
    use HasFactory;

    protected $table = 'seksi';

    protected $guarded = ['created_at','updated_at'];

    public function bidang(){
        return $this->belongsTo(Bidang::class,'bidang_id');
    }
}
