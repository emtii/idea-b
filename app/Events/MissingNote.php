<?php

namespace App\Events;

use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class MissingNote
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var User $user */
    public $user;
    /** @var Timesheet $timeSheet */
    public $timeSheet;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Timesheet $timeSheet
     */
    public function __construct(User $user, Timesheet $timeSheet)
    {
        $this->user = $user;
        $this->timeSheet = $timeSheet;
    }
}
