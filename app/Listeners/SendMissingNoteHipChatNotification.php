<?php declare(strict_types=1);

namespace App\Listeners;

use App\Events\MissingNote;
use Bestit\HipChat\Facade\HipChat;

class SendMissingNoteHipChatNotification
{
    /**
     * Handles the Event, send message to hipchat
     * @param $event MissingNote
     * @return void
     */
    public function handle(MissingNote $event)
    {
        $user = $event->user;
        $timeSheet = $event->timeSheet;

        // send info to user
        HipChat::user($user->getEmail())
            ->notify(
                "Todays work on {$timeSheet->getProject()} with id {$timeSheet->getId()} is faulty.",
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
