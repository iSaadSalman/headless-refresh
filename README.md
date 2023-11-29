# Headless Refresh - Statamic Addon

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
    'trigger_option' => env('HEADLESS_REFRESH_TRIGGER_OPTION', false),
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

- `trigger_option`: Set to `true` to enable the event-based trigger.
- `trigger_link`: Define the URL or link that triggers the headless refresh.
- `deployment_message`: Customize the message displayed upon successful deployment.
- `events`: Specify the events that should trigger the headless refresh.

## Usage

### Event-Based Trigger (Optional)

To enable the event-based trigger, set the `trigger_option` to `true` in the configuration file. This will trigger the headless refresh based on specified events.

### Dashboard Widget

You can add the Headless Refresh widget to your dashboard by including it using its handle `'headless-refresh'`.
