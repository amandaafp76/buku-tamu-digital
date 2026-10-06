document.addEventListener('DOMContentLoaded', function () {

    const qrReader = document.getElementById('qr-reader');
    const scanResult = document.getElementById('scan-result');
    const scanAgain = document.getElementById('scan-again');
    const csrfContainer = document.getElementById('scan-csrf');

    if (!qrReader) {
        return;
    }

    console.log('Scan QR script berhasil dimuat.');

    const findUrl = qrReader.dataset.findUrl;
    const checkoutUrl = qrReader.dataset.checkoutUrl;

    const csrfInput = csrfContainer
        ? csrfContainer.querySelector('input[type="hidden"]')
        : null;

    if (!findUrl) {
        console.error('URL pencarian QR tidak ditemukan.');
        return;
    }

    if (!checkoutUrl) {
        console.error('URL check-out tidak ditemukan.');
        return;
    }

    if (!csrfInput) {
        console.error('CSRF token tidak ditemukan.');
        return;
    }

    const scanner = new Html5Qrcode('qr-reader');

    let scanProcessed = false;

    function startScanner() {

    scanProcessed = false;

    scanResult.classList.add('d-none');

    if (scanAgain) {
        scanAgain.classList.add('d-none');
    }

    scanner.start(
        {
            facingMode: 'environment'
        },
        {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            }
        },
        onScanSuccess,
        onScanFailure
    )
        .then(function () {

            console.log(
                'Kamera scanner berhasil dijalankan.'
            );

        })
        .catch(function (error) {

            console.error(
                'Gagal mengakses kamera:',
                error
            );

            showResult(
                `
                <i class="bi bi-exclamation-triangle"></i>
                Kamera tidak dapat digunakan.
                Silakan periksa izin akses kamera pada browser.
                `,
                'danger'
            );

        });
}

if (scanAgain) {

    scanAgain.addEventListener('click', function () {

        startScanner();

    });

}


    function showResult(message, type = 'secondary') {

        scanResult.classList.remove(
            'd-none',
            'alert-secondary',
            'alert-success',
            'alert-danger',
            'alert-warning'
        );

        scanResult.classList.add(`alert-${type}`);

        scanResult.innerHTML = message;
    }


    function escapeHtml(value) {

        const div = document.createElement('div');

        div.textContent = value ?? '-';

        return div.innerHTML;
    }


    function findVisit(qrToken) {

        const formData = new FormData();

        formData.append('qr_token', qrToken);
        formData.append(
            csrfInput.name,
            csrfInput.value
        );


        fetch(findUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(function (response) {

                return response.json();

            })
            .then(function (data) {

                if (!data.success) {

                    showResult(
                        `
                        <i class="bi bi-exclamation-circle"></i>
                        ${escapeHtml(data.message)}
                        `,
                        'danger'
                    );

                    if (scanAgain) {
                        scanAgain.classList.remove('d-none');
                    }

                    return;
                }


                const visit = data.visit;

                if (data.csrfHash) {
                    csrfInput.value = data.csrfHash;
                }

                showResult(
                    `
                    <div class="text-start">

                        <div class="fw-semibold mb-3">
                            <i class="bi bi-check-circle"></i>
                            Data kunjungan ditemukan
                        </div>

                        <div class="mb-2">
                            <strong>Kode Kunjungan:</strong>
                            ${escapeHtml(visit.visit_code)}
                        </div>

                        <div class="mb-2">
                            <strong>Nama Tamu:</strong>
                            ${escapeHtml(visit.guest_name)}
                        </div>

                        <div class="mb-2">
                            <strong>No. HP:</strong>
                            ${escapeHtml(visit.phone)}
                        </div>

                        <div class="mb-2">
                            <strong>Instansi:</strong>
                            ${escapeHtml(visit.institution)}
                        </div>

                        <div class="mb-2">
                            <strong>Bagian:</strong>
                            ${escapeHtml(visit.department_name)}
                        </div>

                        <div class="mb-2">
                            <strong>Pegawai Tujuan:</strong>
                            ${escapeHtml(visit.employee_name)}
                        </div>

                        <div class="mb-2">
                            <strong>Keperluan:</strong>
                            ${escapeHtml(visit.purpose_name)}
                        </div>

                        <div class="mt-3">
                            <span class="badge bg-success">
                                ${escapeHtml(visit.status)}
                            </span>
                        </div>

                        <div class="mt-4">

                            <button
                                type="button"
                                id="confirm-checkout"
                                class="btn btn-primary w-100">

                                <i class="bi bi-box-arrow-right"></i>
                                Konfirmasi Check-Out

                            </button>

                        </div>

                    </div>
                    `,
                    'success'
                );

                const confirmCheckout =
                    document.getElementById('confirm-checkout');

                if (confirmCheckout) {

                    confirmCheckout.addEventListener(
                        'click',
                        function () {

                            confirmCheckout.disabled = true;

                            confirmCheckout.innerHTML = `
                                <span
                                    class="spinner-border spinner-border-sm me-2">
                                </span>
                                Memproses Check-Out...
                            `;

                            checkOutVisit(visit.id);

                        }
                    );

                }

                console.log(
                    'Data kunjungan ditemukan:',
                    visit
                );

            })
            .catch(function (error) {

                console.error(
                    'Gagal mencari data kunjungan:',
                    error
                );

                showResult(
                    `
                    <i class="bi bi-exclamation-triangle"></i>
                    Terjadi kesalahan saat mencari data kunjungan.
                    `,
                    'danger'
                );

            });
    }

    function checkOutVisit(visitId) {

        const formData = new FormData();

        formData.append('visit_id', visitId);
        formData.append(
            csrfInput.name,
            csrfInput.value
        );

        fetch(checkoutUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(function (response) {

                return response.json();

            })
            .then(function (data) {

                if (!data.success) {

                    showResult(
                        `
                        <i class="bi bi-exclamation-circle"></i>
                        ${escapeHtml(data.message)}
                        `,
                        'danger'
                    );

                    if (scanAgain) {
                        scanAgain.classList.remove('d-none');
                    }

                    return;
                }

                const visit = data.visit;

                if (data.csrfHash) {
                    csrfInput.value = data.csrfHash;
                }

                showResult(
                    `
                    <div class="text-start">

                        <div class="fw-semibold mb-3">
                            <i class="bi bi-check-circle"></i>
                            Check-Out Berhasil
                        </div>

                        <div class="mb-2">
                            <strong>Kode Kunjungan:</strong>
                            ${escapeHtml(visit.visit_code)}
                        </div>

                        <div class="mb-2">
                            <strong>Waktu Check-Out:</strong>
                            ${escapeHtml(visit.check_out)}
                        </div>

                        <div class="mb-3">
                            <strong>Durasi Kunjungan:</strong>
                            ${escapeHtml(visit.duration)} menit
                        </div>

                        <span class="badge bg-secondary">
                            Selesai
                        </span>

                    </div>
                    `,
                    'success'
                );

                if (scanAgain) {
                    scanAgain.classList.remove('d-none');
                }

            })
            .catch(function (error) {

                console.error(
                    'Gagal melakukan check-out:',
                    error
                );

                showResult(
                    `
                    <i class="bi bi-exclamation-triangle"></i>
                    Terjadi kesalahan saat melakukan check-out.
                    `,
                    'danger'
                );

                if (scanAgain) {
                    scanAgain.classList.remove('d-none');
                }

            });
    }

    function onScanSuccess(decodedText) {

        if (scanProcessed) {
            return;
        }

        scanProcessed = true;

        console.log(
            'QR berhasil dibaca:',
            decodedText
        );


        scanner.stop()
            .then(function () {

                console.log(
                    'Kamera scanner dihentikan.'
                );

                findVisit(decodedText);

            })
            .catch(function (error) {

                console.error(
                    'Gagal menghentikan scanner:',
                    error
                );

                findVisit(decodedText);

            });
    }


    function onScanFailure(error) {
    }

    startScanner();
});