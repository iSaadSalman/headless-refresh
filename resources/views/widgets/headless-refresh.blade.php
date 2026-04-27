@php
    $isV6 = version_compare(\Statamic\Statamic::version(), '6.0', '>=');
@endphp

@if ($isV6)
<div class="headless-refresh-card"
     style="border:1px solid rgba(0,0,0,0.08);border-radius:0.5rem;padding:1rem 1.25rem;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1rem;">
    <div class="headless-refresh-card__body" style="flex:1 1 280px;min-width:0;">
        <h2 class="headless-refresh-card__title"
            style="font-size:0.9375rem;font-weight:600;margin:0 0 0.25rem 0;line-height:1.3;">
            {{ config('statamic.headless-refresh.live_updates_notice_title') }}
        </h2>
        <p class="headless-refresh-card__text"
           style="font-size:0.8125rem;line-height:1.5;margin:0;">
            {{ config('statamic.headless-refresh.live_updates_notice_text') }}
        </p>
    </div>
    <div class="headless-refresh-card__action" style="flex-shrink:0;">
        <button type="button"
                class="headless-refresh-btn"
                style="display:inline-flex;align-items:center;justify-content:center;padding:0.5rem 1rem;font-size:0.8125rem;font-weight:600;color:#fff;background-color:var(--ui-primary-600, #1F6FEB);border:0;border-radius:0.375rem;cursor:pointer;white-space:nowrap;">
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
