<?php

return [
    'event_trigger' => env('HEADLESS_REFRESH_EVENT_TRIGGER', false),
    'trigger_link' => env('HEADLESS_REFRESH_TRIGGER_LINK', null),
    'deployment_message' => env('HEADLESS_REFRESH_DEPLOYMENT_MESSAGE', "Deployed"),
    'events' => [
        Statamic\Events\EntrySaved::class,
        Statamic\Events\EntryDeleted::class,
        Statamic\Events\NavSaved::class,
        Statamic\Events\NavDeleted::class,
        Statamic\Events\NavTreeSaved::class,
        Statamic\Events\NavTreeDeleted::class,
        Statamic\Events\TaxonomySaved::class,
        Statamic\Events\TaxonomyDeleted::class,
    ],
    'live_updates_notice_title' => 'Live Updates Notice',
    'live_updates_notice_text' => 'Please note that your updates will be visible online within 5 minutes from when you save an entry. If you require immediate visibility, simply click the button below.',
    'live_updates_notice_button' => 'Refresh Now'
];