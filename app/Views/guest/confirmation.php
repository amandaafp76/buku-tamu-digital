<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <meta
        name="theme-color"
        content="#FBF9D1">

    <title>
        Registrasi Berhasil - Buku Tamu
    </title>

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/bootstrap-icons.css') ?>">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/kiosk.css') ?>">

</head>

<body>

    <div
        class="register-background"
        aria-hidden="true">

        <span class="register-orb register-orb-one"></span>
        <span class="register-orb register-orb-two"></span>
        <span class="register-orb register-orb-three"></span>

    </div>


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

        </div>

    </main>

</body>

</html>