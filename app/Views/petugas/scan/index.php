<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="scan-qr-page">

    <div class="dashboard-header mb-4">

        <div>

            <h1 class="dashboard-heading">
                Scan QR Kunjungan
            </h1>

            <p class="dashboard-subheading">
                Scan QR Code kunjungan tamu untuk memproses check-out.
            </p>

        </div>

    </div>


    <div class="scan-qr-wrapper">

        <div class="glass-card scan-qr-card">

            <div class="scan-qr-header">

                <div class="scan-qr-icon">

                    <i class="bi bi-qr-code-scan"></i>

                </div>

                <h2 class="scan-qr-title">
                    Scan QR Code
                </h2>

                <p class="scan-qr-description">
                    Arahkan kamera ke QR Code kunjungan
                    yang ditunjukkan oleh tamu.
                </p>

            </div>


            <div
                id="qr-reader"
                class="scan-qr-reader"
                data-find-url="<?= site_url('petugas/bukutamu-scan-qr/cari') ?>"
                data-checkout-url="<?= site_url('petugas/bukutamu-scan-qr/check-out') ?>">
            </div>


            <div
                id="scan-result"
                class="scan-qr-result d-none">
            </div>


            <button
                type="button"
                id="scan-again"
                class="dashboard-secondary-button scan-qr-again d-none">

                <i class="bi bi-arrow-repeat"></i>
                Scan QR Lagi

            </button>


            <div id="scan-csrf" class="d-none">
                <?= csrf_field() ?>
            </div>


            <div class="scan-qr-info">

                <i class="bi bi-info-circle"></i>

                <span>
                    Silakan izinkan akses kamera ketika
                    browser meminta izin.
                </span>

            </div>

        </div>

    </div>

</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script src="<?= base_url('assets/js/scan-qr.js') ?>"></script>

<?= $this->endSection() ?>