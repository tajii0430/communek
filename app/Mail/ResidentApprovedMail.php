<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class ResidentApprovedMail extends Mailable
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Resident Registration Approved')
            ->view('emails.approved');
    }
}
