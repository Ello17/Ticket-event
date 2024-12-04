<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'nama_penyelenggara', 
    'cover_event', 
    'nama_event', 
    'tanggal_event', 
    'waktu_event', 
    'lokasi_event', 
    'latitude', 
    'longitude', 
    'maps', 
    'deskripsi_event', 
    'user_id'
];
    protected $table = 'events';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class, 'event_id', 'id');
    }
}
