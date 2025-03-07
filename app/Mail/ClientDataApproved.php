<?php

namespace App\Mail;

use App\Models\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use PDF;
class ClientDataApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $clientData;

    /**
     * Create a new message instance.
     *
     * @param Form $clientData
     */
    public function __construct(Form $clientData)
    {
        $this->clientData = $clientData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Generate PDF from view
        $pdf = PDF::loadView('pdf.client_data', ['clientData' => $this->clientData]);

        return $this->subject('Client Data Approved')
                    ->view('emails.client_data_approved')
                    ->attachData($pdf->output(), 'client_data.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
