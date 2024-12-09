<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $fillable = ['kategori_tiket', 'harga_tiket', 'jumlah_tiket', 'event_id'];

    protected $guarded = ['id'];

    protected $appends = ['formatted_harga'];



    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'tiket_id');
    }


    public function getFormattedHargaAttribute()
    {
        return number_format($this->attributes['harga_tiket'], 0, ',', '.');
    }

    public function isSoldOut()
    {
        return $this->transaksi()->sum('jumlah_tiket') >= $this->jumlah_tiket;
    }

    public function getStatusAttribute()
    {
        return $this->isSoldOut() ? 'sold out' : 'on sale';
    }

    public function getAvailabilityTextAttribute()
    {
        $terjual = $this->transaksi()->sum('jumlah_tiket');
        return "{$terjual}/{$this->jumlah_tiket}";
    }
}
