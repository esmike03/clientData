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
    // public function build()
    // {
    //     // Generate PDF from view
    //     $pdf = PDF::loadView('pdf.client_data', ['clientData' => $this->clientData]);

    //     return $this->subject('Client Data Approved')
    //                 ->view('emails.client_data_approved')
    //                 ->attachData($pdf->output(), 'client_data.pdf', [
    //                     'mime' => 'application/pdf',
    //                 ]);
    // }

    public function build()
    {
        // Create a new mPDF instance
        $mpdf = new \Mpdf\Mpdf();

        // Set password protection:
        // The first parameter is an array of allowed permissions (e.g., print, copy),
        // the second is the user password (needed to open the PDF),
        // and the third is the owner password (which gives full permissions).
        $mpdf->SetProtection(['print', 'copy'], 'Wespoint@2025', 'Wespoint@2025');

        // Render the view and write HTML to the PDF
        $html = view('pdf.client_data', ['clientData' => $this->clientData])->render();
        $mpdf->WriteHTML($html);

        // Get the PDF output as a string
        $pdfOutput = $mpdf->Output('', 'S');

        return $this->subject('Client Data Approved')
            ->view('emails.client_data_approved')
            ->attachData($pdfOutput, 'client_data.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
