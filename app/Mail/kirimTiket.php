<?php

namespace App\Mail;

use App\Models\Transaksi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class kirimTiket extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $transaksi; // Buat properti untuk menyimpan data transaksi

    public $transaksi;

    public function __construct(Transaksi $transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function build()
    {
        return $this->view('emails.kirimTiket')
                    ->with([
                        'transaksi' => $this->transaksi,
                    ])
                    ->subject('Tiket Transaksi Anda');
    }
}
