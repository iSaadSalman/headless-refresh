function initHeadlessRefresh() {
    var headlessButton = document.querySelector('.headless-refresh-btn');

    if (!headlessButton) return false;

    function enableButton(btn) {
        btn.disabled = false;
    }

    function disableButton(btn) {
        btn.disabled = true;
    }

    function showToast(type, message) {
        if (window.Statamic && Statamic.$toast) {
            if (type === 'success') {
                Statamic.$toast.success(message);
            } else {
                Statamic.$toast.error(message);
            }
        } else {
            console[type === 'success' ? 'log' : 'error'](message);
        }
    }

    function getCpUrl() {
        if (window.Statamic && typeof Statamic.cp_url === 'function') {
            return Statamic.cp_url('/');
        }
        var meta = document.querySelector('meta[name="cp-url"]');
        if (meta) return meta.getAttribute('content').replace(/\/$/, '') + '/';
        return '/cp/';
    }

    headlessButton.addEventListener('click', function () {
        var button = this;
        var cpURL = getCpUrl();

        disableButton(button);

        fetch(cpURL + 'headless-refresh/headless-refresh-proxy', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': (
                    document.querySelector('meta[name="csrf-token"]')
                        ? document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        : ''
                )
            }
        })
        .then(function (response) {
            if (response.ok) {
                showToast('success', 'Your website is updated!');
            } else {
                throw new Error('Unexpected status: ' + response.status);
            }
        })
        .catch(function (error) {
            console.error('Headless Refresh error:', error);
            showToast('error', 'Error occurred. Please try again.');
        })
        .finally(function () {
            enableButton(button);
        });
    });

    return true;
}

function waitForButton() {
    // Use MutationObserver to watch for the button being added to the DOM
    // This handles Statamic CP's Vue-rendered dashboard widgets
    var observer = new MutationObserver(function (mutations, obs) {
        if (initHeadlessRefresh()) {
            obs.disconnect(); // Found and initialized — stop watching
        }
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Safety timeout — disconnect after 15s to avoid observing forever
    setTimeout(function () {
        observer.disconnect();
    }, 15000);
}

document.addEventListener('DOMContentLoaded', function () {
    // Try immediately first (in case it's already rendered)
    if (!initHeadlessRefresh()) {
        // Not found yet — wait for Vue to render the widget
        waitForButton();
    }
});