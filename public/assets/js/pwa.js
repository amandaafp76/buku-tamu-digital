(function () {
    'use strict';

    if (!('serviceWorker' in navigator)) {
        console.warn('[PWA] Browser tidak mendukung Service Worker');
        return;
    }

    const SW_URL = '/service-worker.js';
    const SW_SCOPE = '/';

    window.addEventListener('load', () => {
        navigator.serviceWorker
            .register(SW_URL, { scope: SW_SCOPE })
            .then((registration) => {
                console.log('[PWA] Service Worker terdaftar:', registration.scope);

                setupUpdateHandling(registration);
            })
            .catch((error) => {
                console.error('[PWA] Gagal registrasi Service Worker:', error);
            });
    });

    function setupUpdateHandling(registration) {
 
        registration.addEventListener('updatefound', () => {
            const newWorker = registration.installing;

            if (!newWorker) return;

            newWorker.addEventListener('statechange', () => {
                if (
                    newWorker.state === 'installed' &&
                    navigator.serviceWorker.controller
                ) {
                    console.log('[PWA] Versi baru tersedia');

                    window.dispatchEvent(new CustomEvent('pwa:update-available'));
                }
            });
        });
    }

    let deferredInstallPrompt = null;

    window.addEventListener('beforeinstallprompt', (event) => {
        console.log('[PWA] Install prompt tersedia');

        event.preventDefault();

        deferredInstallPrompt = event;

        window.dispatchEvent(new CustomEvent('pwa:install-available'));
    });

    window.addEventListener('appinstalled', () => {
        console.log('[PWA] Aplikasi berhasil di-install');

        deferredInstallPrompt = null;

        window.dispatchEvent(new CustomEvent('pwa:installed'));
    });

    window.pwaInstall = function () {
        if (!deferredInstallPrompt) {
            console.warn('[PWA] Install prompt belum tersedia');
            return Promise.resolve(false);
        }

        deferredInstallPrompt.prompt();

        return deferredInstallPrompt.userChoice.then((choice) => {
            console.log('[PWA] User memilih:', choice.outcome);

            deferredInstallPrompt = null;

            return choice.outcome === 'accepted';
        });
    };

    function createConnectionBadge() {
        if (document.getElementById('pwaConnectionBadge')) {
            return document.getElementById('pwaConnectionBadge');
        }

        const badge = document.createElement('div');
        badge.id = 'pwaConnectionBadge';
        badge.className = 'pwa-connection-badge';
        badge.setAttribute('role', 'status');
        badge.setAttribute('aria-live', 'polite');
        badge.innerHTML = `
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M1 1l22 22"></path>
                <path d="M16.72 11.06A10.94 10.94 0 0 1 19 12.55"></path>
                <path d="M5 12.55a10.94 10.94 0 0 1 5.17-2.39"></path>
                <path d="M10.71 5.05A16 16 0 0 1 22.58 9"></path>
                <path d="M1.42 9a15.91 15.91 0 0 1 4.7-2.88"></path>
                <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
                <line x1="12" y1="20" x2="12.01" y2="20"></line>
            </svg>
            <span>Anda sedang offline</span>
        `;

        document.body.appendChild(badge);

        return badge;
    }

    function updateConnectionBadge(isOnline) {
        const badge = createConnectionBadge();

        if (isOnline) {
            badge.classList.remove('pwa-connection-badge--visible');
        } else {
            badge.classList.add('pwa-connection-badge--visible');
        }
    }

    window.addEventListener('pwa:connection-change', (event) => {
        updateConnectionBadge(event.detail.online);
    });

    function updateOnlineStatus() {
        const isOnline = navigator.onLine;

        console.log('[PWA] Status koneksi:', isOnline ? 'online' : 'offline');

        updateConnectionBadge(isOnline);

        window.dispatchEvent(
            new CustomEvent('pwa:connection-change', {
                detail: { online: isOnline },
            })
        );
    }

    window.addEventListener('online', updateOnlineStatus);
    window.addEventListener('offline', updateOnlineStatus);

    if (document.readyState === 'complete') {
        updateOnlineStatus();
    } else {
        window.addEventListener('load', updateOnlineStatus);
    }
})();