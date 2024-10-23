<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'tiket_dibeli',
        'tanggal_transaksi',
        'total_transaksi',
        'nama_lengkap',
        'no_ktp',
        'no_telepon',
        'email',
        'tiket_id',
        'event_id'
    ];

    public function event(){
        return $this->hasMany(Event::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
