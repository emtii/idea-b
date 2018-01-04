<?php

namespace App\Providers;

use App\Events\Commands\Harvest\UserHasCuriousTimeEntryEvent;
use App\Events\Commands\Harvest\UserHasMissingNoteEvent;
use App\Events\Commands\Harvest\UserHasUnapprovedTimeEntriesEvent;
use App\Listeners\Commands\Harvest\SendHipChatNotificationBecauseOfCuriousTimeEntryListener;
use App\Listeners\Commands\Harvest\SendHipChatNotificationBecauseOfMissingNoteListener;
use App\Listeners\Commands\Harvest\SendHipChatNotificationBecauseOfUnapprovedTimeEntriesListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserHasMissingNoteEvent::class => [
            SendHipChatNotificationBecauseOfMissingNoteListener::class
        ],
        UserHasUnapprovedTimeEntriesEvent::class => [
            SendHipChatNotificationBecauseOfUnapprovedTimeEntriesListener::class
        ],
        UserHasCuriousTimeEntryEvent::class => [
            SendHipChatNotificationBecauseOfCuriousTimeEntryListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
