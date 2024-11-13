<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'event_id',
        'tiket_id',
        'kode_tiket',
        'scan_time',
        'is_present'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'tiket_id');
    }
}
