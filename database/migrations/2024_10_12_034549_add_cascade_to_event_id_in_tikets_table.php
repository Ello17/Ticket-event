<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeToEventIdInTiketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tikets', function (Blueprint $table) {
            // Hapus foreign key lama (jika sudah ada)
            $table->dropForeign(['event_id']);

            // Tambahkan kembali foreign key dengan onDelete('cascade')
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tikets', function (Blueprint $table) {
            // Batalkan cascade delete saat rollback
            $table->dropForeign(['event_id']);

            // Tambahkan foreign key tanpa cascading
            $table->foreign('event_id')
                ->references('id')
                ->on('events');
        });
    }
}
