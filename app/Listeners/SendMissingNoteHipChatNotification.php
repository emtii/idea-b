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
     * @return void
     */
    public function handle(MissingNote $event)
    {
        // send info to user
        HipChat::user($event->user->email)
            ->notify(
                "Todays work on {$event->dayEntry->project} with the id {$event->dayEntry->id} is faulty.",
                true
            );

        // todo: random anonymous blame message to room
        //HipChat::room('Allgemein')
        //  ->notify('
        //      B says: Oooppssss... found faulty time entries',
        //      true
        //);
    }
}
