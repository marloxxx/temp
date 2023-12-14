<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Peminjaman extends Migration
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
            $table->unsignedBigInteger('anggotas_id')->nullable();
            $table->foreign('anggotas_id')->references('id')->on('data_anggotas');
            $table->unsignedBigInteger('bukus_id')->nullable();
            $table->foreign('bukus_id')->references('id')->on('data_bukus');
            $table->date('tanggal_pinjam');
            $table->integer('lama_peminjaman');
            $table->foreignId('user_id')->constrained();
            $table->integer('status');
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
