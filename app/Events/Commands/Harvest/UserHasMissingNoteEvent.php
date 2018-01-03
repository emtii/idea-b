<?php declare(strict_types=1);

namespace App\Events\Commands\Harvest;

use BestIt\Harvest\Models\Timesheet\DayEntry;
use BestIt\Harvest\Models\Users\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserHasMissingNoteEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var User $user */
    public $user;
    /** @var DayEntry $dayEntry */
    public $dayEntry;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param DayEntry $dayEntry
     */
    public function __construct(User $user, DayEntry $dayEntry)
    {
        $this->user = $user;
        $this->dayEntry = $dayEntry;
    }
}
