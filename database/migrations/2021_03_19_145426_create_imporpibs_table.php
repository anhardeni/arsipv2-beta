<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImporpibsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imporpib', function (Blueprint $table) {
            $table->id();
            $table->integer("no_pib");
            $table->string("tgl_pib");
            $table->string("importir");
            $table->string("nip_pfpd");
            $table->string("pfpd");
            $table->string("tgl_tt");
            $table->string("jalur");
            $table->string("nm_terima");
            $table->integer("created_by")->nullable();
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
        Schema::dropIfExists('imporpib');
    }
}
