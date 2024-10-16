<?php

namespace App\Mail;
use App\Models\Event;
use App\Models\Tiket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $tiket;
    public $customer;

    public function __construct(Event $event, Tiket $tiket, $customer)
    {
        $this->event = $event;
        $this->tiket = $tiket;
        $this->customer = $customer;
    }

    public function build()
    {
        return $this->subject('Tiket Event Anda')
                    ->view('emails.tiket');
    }
}
