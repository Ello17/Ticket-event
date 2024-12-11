<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'event_id',
        'user_id',
        'status',
        'snap_token',
        'exp'
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'tiket_id');
    }
    public function participants(){
        return $this->hasMany(Participant::class);
    }


    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($transaksi) {

    //         $transaksi->kode_tiket = 'TMD' .  $transaksi->tiket_id . '-TR' . Str::random(5);
    //     });
    // }
}
