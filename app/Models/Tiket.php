<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id'); // Pastikan kolom 'event_id' dan 'id' sesuai dengan struktur tabel
    }
}
