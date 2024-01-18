<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class ContactGuidance1 extends Mailable
{
    use Queueable, SerializesModels;

    public $studentId;
    public $studentFName;
    public $studentLName;
    public $description;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($studentId, $studentFName, $studentLName,$description)
    {
        $this->studentId = $studentId;
        $this->studentFName = $studentFName;
        $this->studentLName = $studentLName;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('abigail.geroza@tup.edu.ph', 'PASSway')
                    ->view('mail4');
    }
}
