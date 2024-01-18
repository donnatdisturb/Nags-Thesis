<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactStudent1 extends Mailable
{
    use Queueable, SerializesModels;

    public $goodMoral;
    public $studentFName;
    public $studentLName;
    public $guidanceFName;
    public $guidanceLName;
    public $guidanceEmail;
    public $scheduleDate;

    public function __construct($goodMoral, $studentFName, $studentLName, $guidanceFName, $guidanceLName, $guidanceEmail, $scheduleDate)
    {
        $this->goodMoral = $goodMoral;
        $this->studentFName = $studentFName;
        $this->studentLName = $studentLName;
        $this->guidanceFName = $guidanceFName;
        $this->guidanceLName = $guidanceLName;
        $this->guidanceEmail = $guidanceEmail;
        $this->scheduleDate = $scheduleDate; 
    }

    public function build()
    {
        return $this->from($this->guidanceEmail, $this->guidanceFName . ' ' . $this->guidanceLName)
            ->view('mail5')
            ->with([
                'scheduleDate' => $this->scheduleDate 
            ]);
    }
}
