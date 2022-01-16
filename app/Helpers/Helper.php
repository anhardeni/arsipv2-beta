<?php

use App\Models\Sequence;
use Illuminate\Support\Facades\DB;

function getSequence($nama, $tahun){
    DB::beginTransaction();
    try {
        //code...
        $seq = Sequence::where('nama',$nama)->where('tahun',$tahun)->first();
        if($seq){
            $sequenceNumber = ++$seq->sequence;
            $seq->save();
        }else{
            $seq = new Sequence([
                'nama' => $nama,
                'tahun' => $tahun,
                'sequence' => 1,
            ]);
            $seq->save();
            $sequenceNumber = 1;
        }
        DB::commit();
        return $sequenceNumber;
    } catch (\Throwable $th) {
        //throw $th;
        DB::rollBack();
    }
}

?>