<?php

namespace App\Mail;

use App\Models\Transaksi;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class kirimTiket extends Mailable
{
    use Queueable, SerializesModels;

    public $transaksi;

    /**
     * Buat instance baru Mailable.
     *
     * @param  \App\Models\Transaksi  $transaksi
     */
    public function __construct(Transaksi $transaksi)
    {
        $this->transaksi = $transaksi;
    }

    /**
     * Bangun pesan.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Konfirmasi Pembayaran Berhasil')
                    ->view('emails.konfirmasi')
                    ->with([
                        'transaksi' => $this->transaksi,
                    ]);
    }
}
