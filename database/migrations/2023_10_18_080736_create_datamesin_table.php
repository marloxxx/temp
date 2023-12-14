<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatamesinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datamesin', function (Blueprint $table) {
            $table->id();
            $table->string('no_mesin');
            $table->string('klas_mesin');
            $table->string('nama_mesin');
            $table->string('type_mesin');
            $table->string('merk_mesin');
            $table->string('lok_ws');
            $table->string('gambar_mesin')->nullable();
            $table->text('spek_min'); // Menggunakan tipe data text untuk spesifikasi
            $table->text('spek_max'); // Menggunakan tipe data text untuk spesifikasi
            $table->string('pabrik');
            $table->integer('kapasitas'); // Menggunakan tipe data integer untuk jumlah
            $table->integer('tahun_mesin'); // Menggunakan tipe data integer untuk tahun mesin
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
        Schema::dropIfExists('datamesin');
    }
}
