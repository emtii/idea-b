<?php declare(strict_types=1);

namespace App\Listeners\Commands\Harvest;

use App\Events\Commands\Harvest\UserHasMissingNoteEvent;
use Bestit\HipChat\Facade\HipChat;

class SendHipChatNotificationBecauseOfMissingNoteListener
{
    /**
     * Handles the event, sends a message to the user on HipChat.
     *
     * @param MissingNotes $event
     *
     * @return void
     * @throws \Exception
     */
    public function handle(UserHasMissingNoteEvent $event)
    {
        // send info to user
        HipChat::user($event->user->email)
            ->notify(
                "Todays work on {$event->dayEntry->project} with the id {$event->dayEntry->id} is faulty: No Note found. Please add a Note."
            );
    }
}
