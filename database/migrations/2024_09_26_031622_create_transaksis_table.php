<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('tiket_dibeli');
            $table->string('tanggal_transaksi');
            $table->integer('jumlah_tiket');
            $table->integer('total_transaksi');
            $table->string('nama_lengkap');
            $table->string('no_ktp');
            $table->string('no_telepon');
            $table->string('email')->unique();
            $table->foreignId('tiket_id')->constrained();
            $table->foreignId('event_id')->constrained();
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
        Schema::dropIfExists('transaksis');
    }
}
