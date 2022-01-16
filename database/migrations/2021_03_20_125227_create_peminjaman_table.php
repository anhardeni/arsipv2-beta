<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {

            $table->id();
            $table->string('nd_masuk')->unique();
            $table->date('tgl_nd_masuk');
            $table->string('asal_nd');
            $table->string('tujuan_nd');
            $table->string('perihal');
            $table->string('nd_keluar')->nullable();
            $table->date('tgl_nd_keluar')->nullable();
            $table->string('tujuan_nd_keluar')->nullable();
            $table->string('nd_kembali')->nullable();
            $table->date('tgl_nd_kembali')->nullable();
            $table->string('keterangan_nd_kembali')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
