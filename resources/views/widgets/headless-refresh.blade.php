<div class="card p-0 content flex flex-col md:flex-row justify-between">
    <div class="py-6 px-8 flex items-center">
        <div>
            <h1>{{ config('statamic.headless-refresh.live_updates_notice_title') }}</h1>
            <p>{{ config('statamic.headless-refresh.live_updates_notice_text') }}</p>
        </div>
    </div>
    <div class="items-center p-2 mt-10 md:mt-0">
        <p class="py-3 px-4 text-center">
            <button class="btn-primary headless-refresh-btn">{{ config('statamic.headless-refresh.live_updates_notice_button') }}</button>
        </p>
    </div>
</div>