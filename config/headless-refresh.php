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
];