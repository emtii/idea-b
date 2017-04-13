<?php declare(strict_types=1);

namespace App\Listeners;

use App\Events\MissingTimeEntry;
use Bestit\HipChat\Facade\HipChat;

class SendMissingTimeEntriesHipChatNotification
{
    /**
     *
     */
    public function handle(MissingTimeEntry $event)
    {
        $user = $event->user;

        // send info to user
        HipChat::user($user->getEmail())
            ->notify(
                "There where no time entries by you yesterday. What was wrong?",
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
