<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBukusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_bukus', function (Blueprint $table) {
            $table->id();
            $table->string('no_mesin');
            $table->string('nama_mesin');
            $table->foreignId('data_kategori_id')->constrained('data_kategoris'); // Sesuaikan dengan nama tabel yang benar
            $table->string('book_image')->nullable();
            $table->text('spek'); // Menggunakan tipe data text untuk spesifikasi
            $table->integer('jumlah'); // Menggunakan tipe data integer untuk jumlah
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('data_bukus');
    }
}
