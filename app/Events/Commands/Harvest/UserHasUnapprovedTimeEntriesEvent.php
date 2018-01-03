<?php declare(strict_types=1);

namespace App\Events\Commands\Harvest;

use BestIt\Harvest\Models\Timesheet\DayEntry;
use BestIt\Harvest\Models\Users\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserHasUnapprovedTimeEntriesEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var string $email */
    public $email;

    /**
     * Create a new event instance.
     *
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }
}
