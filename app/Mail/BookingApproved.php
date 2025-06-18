<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Booking Disetujui',
    //     );
    // }

    public function build()
    {
        return $this->subject('Booking Disetujui')
                    ->view('emails.booking_approve')
                    ->with([
                        'bookings' => $this->booking,
                    ]);
    }

    public function attachments(): array
    {
        return [];
    }
}
