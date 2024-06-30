# Headless Refresh - Statamic Addon

The Statamic Headless Refresh addon enhances your Statamic experience by seamlessly integrating headless CMS capabilities. It provides a convenient dashboard widget that allows you to trigger updates to your decoupled website directly from the Statamic backend. The plugin also supports automated URL triggers tied to specific events, such as when an entry is saved, ensuring your headless site is always up-to-date. Events are also customizable.

## Key Features
1. **Dashboard Widget:** Optionally add a widget to your Statamic dashboard for easy manual refreshes.
2. **Event-Driven Triggers:** Automate the refresh process by tying URL triggers to events like entry saves.

Effortlessly manage and synchronize your headless CMS updates with Statamic Headless Refresh.

## Installation

To install the Headless Refresh addon, follow these steps:

1. Install the addon via Composer:
   ```bash
   composer require isaadsalman/headless-refresh
   ```

2. Publish the addon assets and configuration:
   ```bash
   php artisan vendor:publish --tag=headless-refresh-config
   ```

3. Update the configuration file `config/statamic/headless-refresh.php` as needed (see the Configuration section below).

## Configuration

The configuration for the Headless Refresh addon is found in `config/statamic/headless-refresh.php`. Modify the following options as required:

```php
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
```

### Configuration Options:

- `event_trigger`: Set to `true` to enable the event-based trigger.
- `trigger_link`: Define the URL or link that triggers the headless refresh.
- `deployment_message`: Customize the message displayed upon successful deployment.
- `events`: Specify the events that should trigger the headless refresh.

## Usage

### Event-Based Trigger (Optional)

To enable the event-based trigger, set the `event_trigger` to `true` in the configuration file. This will trigger the headless refresh based on specified events.

### Dashboard Widget

You can add the Headless Refresh widget to your dashboard by including it using its handle `'headless-refresh'`.
