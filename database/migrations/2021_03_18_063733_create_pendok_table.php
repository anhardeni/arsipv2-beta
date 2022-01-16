<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendok', function (Blueprint $table) {
            $table->id();
            $table->integer("no_pib");
            $table->string("tgl_pib");
            $table->string("importir");
            $table->string("nip_pfpd")->nullable();
            $table->string("pfpd");
            $table->string("tgl_tt")->nullable();
            $table->string("jalur");
            $table->string("nm_terima")->nullable();
            $table->foreignId('batch_id')->nullable();
            $table->foreignId('peminjaman_id')->nullable();
            $table->integer("created_by")->nullable();
            $table->timestamps();
            
            //validasi dengan 2 parameter
            $table->unique(['no_pib','tgl_pib']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendok');
    }
}
