<?php declare(strict_types=1);

namespace App\Listeners;

use App\Events\MissingNote;
use Bestit\HipChat\Facade\HipChat;

class SendMissingNoteHipChatNotification
{
    /**
     * Handles the event, sends a message to the user on HipChat.
     *
     * @param MissingNote $event
     *
     * @return void
     * @throws \Exception
     */
    public function handle(MissingNote $event)
    {
        // send info to user
        HipChat::user($event->user->email)
            ->notify(
                "Todays work on {$event->dayEntry->project} with the id {$event->dayEntry->id} is faulty: No Note found."
            );
    }
}
