<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewDataApproved extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        // No parameters needed
    }

    public function build()
    {
        return $this->subject('New Client Data Sent')
                    ->view('emails.newdata'); // Make sure this view exists
    }
}

