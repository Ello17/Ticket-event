<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\AccountApproved;
use App\Events\AccountRejected;
use Illuminate\Support\Facades\Mail;

class SendAccountNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;

        if ($event instanceof AccountApproved) {
            Mail::to($user->email)->send(new \App\Mail\AccountApprovedMail($user));
        } elseif ($event instanceof AccountRejected) {
            Mail::to($user->email)->send(new \App\Mail\AccountRejectedMail($user));
        }
    }
}
