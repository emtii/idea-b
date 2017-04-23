<?php declare(strict_types=1);

namespace App\Listeners;

use App\Events\MissingTimeEntry;
use Bestit\HipChat\Facade\HipChat;

class SendMissingTimeEntriesHipChatNotification
{
    /**
     * Send a message to the user to let them know that they might've forgotten
     * to log their work time.
     *
     * @param MissingTimeEntry $event
     * @return void
     */
    public function handle(MissingTimeEntry $event)
    {
        // send info to user
        HipChat::user($event->user->email)
            ->notify(
                'There where no time entries by you yesterday. What was wrong?',
                true
            );

        // todo: random anonymous blame message to room
        //HipChat::room('Allgemein')
        //  ->notify('
        //      B says: Oooppssss... found missing time entries',
        //      true
        //);
    }
}
