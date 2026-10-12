(function () {
    'use strict';

    const BUTTON_ID = 'installPromptButton';
    
    window.addEventListener('pwa:install-available', () => {
        showInstallButton();
    });

    window.addEventListener('pwa:installed', () => {
        hideInstallButton();
    });

    function setupClickListener() {
        const button = document.getElementById(BUTTON_ID);

        if (!button) return;

        button.addEventListener('click', async () => {

            if (typeof window.pwaInstall !== 'function') {
                console.warn('[Install] pwaInstall API tidak tersedia');
                return;
            }

            const accepted = await window.pwaInstall();

            if (accepted) {
                console.log('[Install] User menerima install');
                hideInstallButton();
            } else {
                console.log('[Install] User menolak install');
            }
        });
    }

    function showInstallButton() {
        const button = document.getElementById(BUTTON_ID);

        if (!button) return;

        button.hidden = false;

        console.log('[Install] Tombol install ditampilkan');
    }

    function hideInstallButton() {
        const button = document.getElementById(BUTTON_ID);

        if (!button) return;

        button.hidden = true;

        console.log('[Install] Tombol install disembunyikan');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupClickListener);
    } else {
        setupClickListener();
    }

})();