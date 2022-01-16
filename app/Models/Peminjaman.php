<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasStatus;

class Peminjaman extends Model
{
    use HasFactory;
    use HasStatus;
    protected $table = 'peminjaman';
    protected $guarded = ['created_at','updated_at'];

    public function pendok(){
        return $this->hasMany(Pendok::class, 'peminjaman_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
