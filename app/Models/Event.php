<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }

    public function tikets()
    {
        return $this->hasMany(Tiket::class, 'event_id', 'id'); // Pastikan kolom 'event_id' dan 'id' sesuai dengan struktur tabel
    }
}
