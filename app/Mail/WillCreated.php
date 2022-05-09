<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class WillCreated extends Mailable
{
    use Queueable, SerializesModels;

    private $will;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($will)
    {
        $this->will = $will;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = Pdf::loadView('dashboard.willform.print.index', [
            'data' => $this->will,
        ]);
        return $this->markdown('emails.will.created')->attachData($pdf->output(), 'will.pdf');
    }
}
