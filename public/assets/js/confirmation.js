(function () {
    'use strict';

    const TIMEOUT_SECONDS = 30;
    const REDIRECT_URL = '/bukutamu-kiosk';

    let remainingSeconds = TIMEOUT_SECONDS;
    let timerInterval = null;

    const countdownElement = document.getElementById('confirmationCountdown');

    if (!countdownElement) {
       
        console.warn('[CONFIRMATION] Elemen countdown tidak ditemukan');

        setTimeout(function () {
            window.location.href = REDIRECT_URL;
        }, TIMEOUT_SECONDS * 1000);

        return;
    }

    countdownElement.textContent = remainingSeconds;

    timerInterval = setInterval(function () {
        remainingSeconds--;

        if (remainingSeconds <= 0) {
            clearInterval(timerInterval);
            timerInterval = null;

            window.location.href = REDIRECT_URL;

            return;
        }

        countdownElement.textContent = remainingSeconds;
    }, 1000);

})();