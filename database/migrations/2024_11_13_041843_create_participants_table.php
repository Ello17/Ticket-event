<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id(); // Ini sudah benar sebagai primary key auto-increment
            $table->foreignId('user_id')->constrained(); // Foreign key ke tabel users
            $table->foreignId('event_id')->constrained(); // Foreign key ke tabel events
            $table->foreignId('tiket_id')->constrained(); // Foreign key ke tabel tiket
            $table->string('kode_tiket')->unique(); // Kolom kode_tiket yang sesuai dengan query
            $table->timestamp('scan_time')->nullable(); // Kolom scan_time (boleh null)
            $table->boolean('is_present')->default(false); // Kolom is_present dengan default false
            $table->timestamps(); // Kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
