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
            $table->bigIncrements('id');
            $table->string('tiket_dibeli');
            $table->dateTime('tanggal_transaksi');
            $table->integer('total_transaksi');
            $table->string('nama_lengkap');
            $table->string('no_ktp');
            $table->string('no_telepon');
            $table->string('email');
            $table->enum('status', ['pending', 'paid', 'failed']);
            $table->string('snap_token')->nullable();
            $table->dateTime('exp')->nullable();
            $table->foreignId('tiket_id')->constrained();
            $table->foreignId('event_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('order_id')->nullable()->change();

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
        Schema::table('transaksis', function (Blueprint $table) {
            $table->string('order_id')->nullable(false)->change();
        });
    }
}
