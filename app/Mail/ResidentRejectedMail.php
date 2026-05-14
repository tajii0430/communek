<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ResidentRejectedMail extends Mailable
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Resident Registration Rejected')
            ->view('emails.rejected');
    }
}
