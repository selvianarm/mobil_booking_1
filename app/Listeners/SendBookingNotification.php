<?php

namespace App\Listeners;

use App\Events\BookingStatusChanged;
use App\Mail\BookingApproved;
use App\Mail\BookingRejected;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBookingNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookingStatusChanged $event)
    {
        $booking = $event->booking;

        if ($booking->status === 'disetujui') {
            Mail::to($booking->user->email)->send(new BookingApproved($booking));
        } elseif ($booking->status === 'ditolak') {
            Mail::to($booking->user->email)->send(new BookingRejected($booking));
        }
    }
}
