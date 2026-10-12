<?= $this->extend('layouts/kiosk') ?>

<?= $this->section('content') ?>

<main class="register-page">

    <div class="register-shell">

        <section class="register-card">

            <div class="register-card-header">

                <div
                    class="register-card-icon"
                    aria-hidden="true">

                    <i class="bi bi-check2-circle"></i>

                </div>

                <h1 class="register-card-title">
                    Registrasi Berhasil
                </h1>

                <p class="register-card-description">
                    Data kunjungan Anda telah berhasil dikirim
                    dan sedang menunggu verifikasi petugas.
                </p>

            </div>


            <div class="consent-section">

                <div class="consent-section-title">

                    <i
                        class="bi bi-ticket-perforated"
                        aria-hidden="true">
                    </i>

                    <span>
                        Kode Kunjungan
                    </span>

                </div>


                <div class="consent-box">

                    <strong>
                        <?= esc($visit['visit_code']) ?>
                    </strong>

                </div>

            </div>

            <div class="consent-section">

                <div class="consent-section-title">

                    <i
                        class="bi bi-qr-code"
                        aria-hidden="true">
                    </i>

                    <span>
                        QR Kunjungan
                    </span>

                </div>


                <div class="consent-box">

                    <img
                        src="<?= esc($qrCode) ?>"
                        alt="QR Code Kunjungan"
                        style="width: 280px; max-width: 100%; height: auto;">

                    <p>
                        Tunjukkan QR Code ini kepada petugas
                        saat proses kunjungan.
                    </p>

                </div>

            </div>


            <div class="consent-section">

                <div class="consent-section-title">

                    <i
                        class="bi bi-hourglass-split"
                        aria-hidden="true">
                    </i>

                    <span>
                        Status Kunjungan
                    </span>

                </div>


                <div class="consent-box">

                    <strong>
                        Menunggu
                    </strong>

                    <p>
                        Silakan tunggu petugas melakukan verifikasi
                        dan proses check-in.
                    </p>

                </div>

            </div>

        </section>

        <div class="confirmation-timer-info">

            <i class="bi bi-clock-history" aria-hidden="true"></i>

            <span>
                Halaman ini akan kembali otomatis dalam
                <strong id="confirmationCountdown">30</strong>
                detik
            </span>

        </div>

        <div class="confirmation-actions">

            <a
                href="<?= site_url('bukutamu-kiosk') ?>"
                class="register-primary">

                <span>
                    Kembali ke Beranda
                </span>

                <span
                    class="register-primary-icon"
                    aria-hidden="true">

                    <i class="bi bi-house-door"></i>

                </span>

            </a>

        </div>

    </div>

</main>

<?= $this->endSection() ?>


<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/confirmation.js') ?>"></script>

<?= $this->endSection() ?>