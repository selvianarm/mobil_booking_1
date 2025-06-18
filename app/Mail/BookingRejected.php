<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the message envelope.
     */
   
    public function build()
    {
        return $this->subject('Booking Ditolak')
                    ->view('emails.booking_rejected')
                    ->with([
                        'bookings' => $this->booking,
                    ]);
    }


    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
