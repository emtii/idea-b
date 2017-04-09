<?php declare(strict_types=1);

namespace App\Listeners;

use App\Events\MissingNote;
use Bestit\HipChat\Facade\HipChat;

class SendMissingNoteHipChatNotification
{
    /**
     * @inheritdoc
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

        // todo: random blame message to room
        //HipChat::room('Allgemein')
        //  ->notify('
        //      B says: Oooppssss... found faulty time entries',
        //      true
        //);
    }
}
