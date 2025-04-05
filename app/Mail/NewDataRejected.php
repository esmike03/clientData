<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewDataRejected extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        // No parameters needed
    }

    public function build()
    {
        return $this->subject('Your Client Data has been rejected')
                    ->view('emails.newdatax'); // Make sure this view exists
    }
}

