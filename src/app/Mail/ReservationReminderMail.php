<?php

namespace App\Mail;

use App\Models\Reserve;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reserve $reservation)
    {
        $this->reservation = $reservation->load(['shop','user']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.reservation_reminder')
            ->from('AdminMail@rese.com', 'Rese')
            ->subject('【リマインダー】予約のお知らせ - ')
            ->with('reservation', $this->reservation,);
    }
}

