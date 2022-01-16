<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasStatus;

class Kardus extends Model
{
    use HasFactory;
    use HasStatus;
    protected $table = "kardus";
    protected $guarded = ["created_at","udpated_at"];
    
    public function batching(){
        return $this->hasMany(Batching::class, 'kardus_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getNamaPetugasAttribute(){
        return $this->user->name;
    }

    public function gudang(){
        return $this->hasMany(Gudang::class);
    }
}
