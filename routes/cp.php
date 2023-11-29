<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

Route::get('headless-refresh/headless-refresh-proxy', function (Request $request) {
    $triggerLink = config('headless-refresh.trigger_link');

    try {
        $response = Http::get($triggerLink);

        if ($response->successful()) {
            return $response->json();
        } else {
            return response()->json([
                'message' => 'Request failed. Non-200 status received.',
                'status' => 'failure',
            ], $response->status());
        }
    } catch (\Throwable $th) {
        return response()->json([
            'message' => 'An error occurred while processing the request.',
            'status' => 'failure',
        ], 500); // You can adjust the status code as needed (500 for internal server error)
    }
})->name('headless-refresh.proxy');

