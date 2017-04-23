<?php declare(strict_types=1);

namespace App\Events;

use BestIt\Harvest\Models\Users\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class MissingTimeEntry
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var User $user */
    public $user;

    /**
     * Create a new event instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
