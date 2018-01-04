<?php

namespace App\Events\Commands\Harvest;

use BestIt\Harvest\Models\Timesheet\DayEntry;
use BestIt\Harvest\Models\Users\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserHasCuriousTimeEntryEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $dayEntry;
    public $user;

    public function __construct(
        DayEntry $dayEntry,
        User $user
    ) {
        $this->dayEntry = $dayEntry;
        $this->user = $user;
    }
}
