(function () {
    'use strict';

    function showToast(type, message) {
        if (window.Statamic && Statamic.$toast) {
            // Call methods directly so `this` stays bound to Statamic.$toast
            if (type === 'success') {
                Statamic.$toast.success(message);
            } else {
                Statamic.$toast.error(message);
            }
        } else {
            (type === 'success' ? console.log : console.error)('[Headless Refresh] ' + message);
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

    function getCsrfToken() {
        var meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    function handleClick(button) {
        button.disabled = true;

        fetch(getCpUrl() + 'headless-refresh/headless-refresh-proxy', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': getCsrfToken(),
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(function (response) {
            if (!response.ok) {
                throw new Error('Unexpected status: ' + response.status);
            }
            showToast('success', 'Your website is updated!');
        })
        .catch(function (error) {
            console.error('Headless Refresh error:', error);
            showToast('error', 'Error occurred. Please try again.');
        })
        .finally(function () {
            button.disabled = false;
        });
    }

    // Event delegation — works regardless of when/where the widget renders
    document.addEventListener('click', function (e) {
        var button = e.target.closest && e.target.closest('.headless-refresh-btn');
        if (!button) return;
        e.preventDefault();
        handleClick(button);
    });
})();
