<?php declare(strict_types=1);

namespace App\Listeners\Commands\Harvest;

use App\Events\Commands\Harvest\UserHasCuriousTimeEntryEvent;
use Bestit\HipChat\Facade\HipChat;

class SendHipChatNotificationBecauseOfCuriousTimeEntryListener
{
    /**
     * Handles the event, sends a message to the user on HipChat.
     *
     * @param UserHasCuriousTimeEntryEvent $event
     *
     * @return void
     * @throws \Exception
     */
    public function handle(UserHasCuriousTimeEntryEvent $event)
    {
        // send info to user
        HipChat::user($event->user->email)
            ->notify(
                "Todays work on {$event->dayEntry->project} with the id {$event->dayEntry->id} is curious: Please have a look if this one is correct."
            );
    }
}
