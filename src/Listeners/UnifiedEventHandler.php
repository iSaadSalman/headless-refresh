<?php 

namespace Isaadsalman\HeadlessRefresh\Listeners;

use Illuminate\Support\Facades\Http;
use Statamic\Facades\CP\Toast;

// Import other Statamic event classes as needed

class UnifiedEventHandler
{
    public function handle($event)
    {
        $this->triggerUpdateLink();
    }

    private function triggerUpdateLink()
    {
        $triggerLink = config('statamic.headless-refresh.trigger_link');
        $deploymentMessage = config('statamic.headless-refresh.deployment_message');

        if ($triggerLink) {
            // Use try-catch block to handle exceptions
            try {
                $response = Http::get($triggerLink);

                if ($response->successful()) {
                    Toast::success($deploymentMessage);
                } else {
                    Toast::error('Failed to deploy');
                }
            } catch (\Exception $e) {
                Toast::error('Failed to trigger update: ' . $e->getMessage());
            }
        } else {
            Toast::error('Headless Refresh: Trigger link is not defined');
        }
    }
}
