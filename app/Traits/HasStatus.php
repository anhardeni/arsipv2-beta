<?php

namespace App\Traits;

use App\Models\Status;

trait HasStatus {
    public function status(){
        return $this->morphMany(Status::class,'statusable');
    }

    public function getLastStatusAttribute(){
        return $this->status()->latest()->first();
    }

}
