<?php declare(strict_types=1);

namespace App\Listeners\Commands\Harvest;

use App\Events\Commands\Harvest\UserHasUnapprovedTimeEntriesEvent;
use App\Exceptions\UserWasNotFoundException;
use Bestit\HipChat\Facade\HipChat;

class SendHipChatNotificationBecauseOfUnapprovedTimeEntriesListener
{
    /**
     * Handles the event, sends a message to the user on HipChat.
     *
     * @param UserHasUnapprovedTimeEntriesEvent $event
     *
     * @return void
     * @throws \Exception
     */
    public function handle(UserHasUnapprovedTimeEntriesEvent $event)
    {
        // send info to user
        HipChat::user($event->email)
               ->notify(
                   "You still have unapproved time entries created last week. Please submit your week and make sure you get your entries approved."
               );
    }
}
