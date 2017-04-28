<?php declare(strict_types=1);

namespace App\Events;

use BestIt\Harvest\Models\Users\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class BookedLessThan
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var User $user */
    public $user;
    /** @var float $hours */
    public $hours;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param float $hours
     */
    public function __construct(User $user, float $hours)
    {
        $this->user = $user;
        $this->hours = $hours;
    }
}
