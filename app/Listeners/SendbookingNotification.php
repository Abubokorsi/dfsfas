<?php

namespace App\Listeners;

use App\Events\bookingProcessed;
use App\Mail\BookingMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendbookingNotification
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
     * @param  \App\Events\bookingProcessed  $event
     * @return void
     */
    public function handle(bookingProcessed $event)
    {
        Mail::to(Auth::user()->email)->send(new BookingMail($event->booking));
    }
}
