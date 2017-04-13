<?php declare(strict_types=1);

namespace App\Mail\Check;

use App\Models\Timesheet;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MissingNotesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $day;

    public function __construct(Timesheet $day)
    {
        $this->day = $day;
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
