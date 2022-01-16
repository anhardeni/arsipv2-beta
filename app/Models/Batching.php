<?php

namespace App\Models;

use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batching extends Model
{
    use HasFactory;
    use HasStatus;
    protected $table = 'batching';
    protected $guarded = ['created_at','updated_at'];

    //start relasi pendok ke batching
    public function pendok(){
        return $this->hasMany(Pendok::class, 'batch_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getNamaPetugasAttribute(){
        return $this->user->name;
    }

    public function kardus(){
        return $this->belongsTo(Kardus::class, 'kardus_id');
    }
    
}
