<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <div class="mb-4">

        <h1>Scan QR Kunjungan</h1>

        <p class="text-muted">
            Scan QR Code kunjungan tamu untuk memproses check-out.
        </p>

    </div>


    <div class="row justify-content-center">

        <div class="col-lg-7 col-xl-6">

            <div class="glass-card p-4 text-center">

                <div class="mb-4">

                    <div class="fs-1 text-primary mb-3">
                        <i class="bi bi-qr-code-scan"></i>
                    </div>

                    <h4 class="mb-2">
                        Scan QR Code
                    </h4>

                    <p class="text-muted mb-0">
                        Arahkan kamera ke QR Code kunjungan
                        yang ditunjukkan oleh tamu.
                    </p>

                </div>


                <div
                    id="qr-reader"
                    class="mb-4"
                    data-find-url="<?= site_url('petugas/bukutamu-scan-qr/cari') ?>"
                    data-checkout-url="<?= site_url('petugas/bukutamu-scan-qr/check-out') ?>">
                </div>

                <div
                    id="scan-result"
                    class="alert alert-secondary d-none">
                </div>

                <button
                    type="button"
                    id="scan-again"
                    class="btn btn-outline-primary d-none">

                    <i class="bi bi-arrow-repeat"></i>
                    Scan QR Lagi

                </button>

                <div id="scan-csrf" class="d-none">
                    <?= csrf_field() ?>
                </div>


                <div class="alert alert-info mb-0">

                    <i class="bi bi-info-circle"></i>

                    Silakan izinkan akses kamera ketika
                    browser meminta izin.

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script src="<?= base_url('assets/js/scan-qr.js') ?>"></script>

<?= $this->endSection() ?>