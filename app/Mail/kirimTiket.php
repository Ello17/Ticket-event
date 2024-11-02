<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class kirimTiket extends Mailable
{
    use Queueable, SerializesModels;

    public $transaksi; // Buat properti untuk menyimpan data transaksi

    /**
     * Create a new message instance.
     *
     * @param $transaksi
     * @return void
     */
    public function __construct($transaksi)
    {
        $this->transaksi = $transaksi; // Simpan data transaksi ke properti
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Tiket Event Mudah')
                    ->view('emails.kirimtiket')
                    ->with(['transaksi' => $this->transaksi]); 
    }
}
