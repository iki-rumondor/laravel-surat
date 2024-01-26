<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis', 75);
            $table->string('unit', 75);
            // $table->string('nomor', 75);
            $table->date('tanggal_surat');
            $table->date('tanggal_keluar');
            $table->string('perihal', 150);
            $table->string('ttd', 150);
            $table->string('lampiran', 250)->nullable();
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
        Schema::dropIfExists('surat_keluar');
    }
}
