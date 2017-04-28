<?php

namespace App\Providers;

use App\Events\BookedLessThan;
use App\Events\MissingNote;
use App\Events\MissingTimeEntry;
use App\Listeners\SendBookedLessThanHipChatNotification;
use App\Listeners\SendMissingNoteHipChatNotification;
use App\Listeners\SendMissingTimeEntriesHipChatNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        MissingNote::class => [
            SendMissingNoteHipChatNotification::class
        ],
        MissingTimeEntry::class => [
            SendMissingTimeEntriesHipChatNotification::class
        ],
        BookedLessThan::class => [
            SendBookedLessThanHipChatNotification::class
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
