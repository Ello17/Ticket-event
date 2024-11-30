<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'user_id', 'event_id', 'tiket_id', 'kode_tiket', 'status', 'scan_time', 'is_present', 'transaksi_id',
        'kode_tiket',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }
    public function transaksi()
{
    return $this->belongsTo(Transaksi::class, 'transaksi_id');
}

}