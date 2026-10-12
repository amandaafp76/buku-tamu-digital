(function () {
    'use strict';

    document.addEventListener('submit', function (event) {
        const form = event.target;

        if (!form.hasAttribute('data-offline-guard')) {
            return;
        }

        if (!navigator.onLine) {

            event.preventDefault();
            event.stopPropagation();

            showOfflineMessage();

            return false;
        }

    }, true);

    function showOfflineMessage() {

        let toast = document.getElementById('formGuardToast');

        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'formGuardToast';
            toast.className = 'form-guard-toast';
            toast.setAttribute('role', 'alert');
            toast.innerHTML = `
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M1 1l22 22"></path>
                    <path d="M16.72 11.06A10.94 10.94 0 0 1 19 12.55"></path>
                    <path d="M5 12.55a10.94 10.94 0 0 1 5.17-2.39"></path>
                    <path d="M10.71 5.05A16 16 0 0 1 22.58 9"></path>
                    <path d="M1.42 9a15.91 15.91 0 0 1 4.7-2.88"></path>
                    <path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path>
                    <line x1="12" y1="20" x2="12.01" y2="20"></line>
                </svg>
                <span>Tidak dapat mengirim. Anda sedang offline.</span>
            `;

            document.body.appendChild(toast);
        }

        toast.classList.add('form-guard-toast--visible');

        clearTimeout(window.__formGuardTimeout);
        window.__formGuardTimeout = setTimeout(() => {
            toast.classList.remove('form-guard-toast--visible');
        }, 3000);
    }
})();