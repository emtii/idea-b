<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MissingNotes extends Mailable
{
    use Queueable, SerializesModels;

    public $entry;

    public function __construct($entry)
    {
        $this->entry = $entry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->markdown('emails.check.missing_notes');
    }
}
