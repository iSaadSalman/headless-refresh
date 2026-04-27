@php
    $isV6 = version_compare(\Statamic\Statamic::version(), '6.0', '>=');
@endphp

@if ($isV6)
<div class="bg-white dark:bg-gray-800 rounded-lg shadow flex flex-col md:flex-row md:items-center md:justify-between">
    
    <div class="px-6 py-5">
        <h1 class="text-lg font-semibold">
            {{ config('statamic.headless-refresh.live_updates_notice_title') }}
        </h1>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
            {{ config('statamic.headless-refresh.live_updates_notice_text') }}
        </p>
    </div>

    <div class="px-6 pb-5 md:pb-0 md:pr-6 flex justify-center">
        <button
            class="cursor-pointer btn-primary headless-refresh-btn px-8 py-3 text-base font-semibold
                   transition duration-200 ease-in-out
                   hover:opacity-90 hover:shadow-lg
                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
            {{ config('statamic.headless-refresh.live_updates_notice_button') }}
        </button>
    </div>

</div>
@else

<div class="card p-0 content flex flex-col md:flex-row justify-between">
    <div class="py-6 px-8 flex items-center">
        <div>
            <h1>
                {{ config('statamic.headless-refresh.live_updates_notice_title') }}
            </h1>
            <p>
                {{ config('statamic.headless-refresh.live_updates_notice_text') }}
            </p>
        </div>
    </div>
    <div class="items-center p-2 mt-10 md:mt-0">
        <p class="py-3 px-4 text-center">
            <button class="btn-primary headless-refresh-btn cursor-pointer">
                {{ config('statamic.headless-refresh.live_updates_notice_button') }}
            </button>
        </p>
    </div>
</div>

@endif