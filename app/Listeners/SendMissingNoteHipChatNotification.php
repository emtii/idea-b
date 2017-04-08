<?php

declare(strict_types=1);

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

        // todo: find out what information actually needs to be sent instead of the id.
        HipChat::user($user->getEmail())
            ->notify("Hello, it seems like you have done something wrong on the time entry with the ID of {$timeSheet->getId()}", true);
    }
}
