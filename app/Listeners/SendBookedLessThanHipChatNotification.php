<?php declare(strict_types=1);

namespace App\Listeners;

use App\Events\BookedLessThan;
use Bestit\HipChat\Facade\HipChat;

class SendBookedLessThanHipChatNotification
{
    /**
     * Handles the event, sends a message to the user on HipChat.
     *
     * @param BookedLessThan $event
     * @return void
     */
    public function handle(BookedLessThan $event)
    {
        // send info to user
        HipChat::user($event->user->email)
            ->notify(
                "You have logged less than {$event->hours} hours of work today. What was wrong?",
                true
            )
        ;
    }
}
