<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $oldVehicle;
    public $newVehicle;

    public function __construct(Booking $booking, $oldVehicle, $newVehicle)
    {
        $this->booking = $booking;
        $this->oldVehicle = $oldVehicle;
        $this->newVehicle = $newVehicle;
    }

    public function build()
    {
        return $this->subject('Perubahan Booking Kendaraan')
                    ->view('emails.booking-updated');
    }
}
