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
        Buku Tamu - Kiosk
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
        class="kiosk-background"
        aria-hidden="true">

        <span
            class="kiosk-orb kiosk-orb-one">
        </span>

        <span
            class="kiosk-orb kiosk-orb-two">
        </span>

        <span
            class="kiosk-orb kiosk-orb-three">
        </span>

    </div>


    <main class="kiosk-page">

        <div class="kiosk-shell">

            <section class="kiosk-card">

                <div class="kiosk-status">

                    <span
                        class="kiosk-status-dot"
                        aria-hidden="true">
                    </span>

                    <span>
                        Sistem siap digunakan
                    </span>

                </div>

                <div class="kiosk-brand">

                    <div
                        class="kiosk-brand-icon"
                        aria-hidden="true">

                        <i
                            class="bi bi-journal-bookmark">
                        </i>

                    </div>

                </div>

                <div class="kiosk-eyebrow">
                    Buku Tamu Digital
                </div>


                <h1 class="kiosk-title">
                    Selamat Datang
                </h1>


                <p class="kiosk-description">

                    Senang menyambut kedatangan Anda.
                    Silakan isi buku tamu digital
                    untuk memulai kunjungan.

                </p>

                <a
                    href="<?= site_url('bukutamu-kiosk/registrasi') ?>"
                    class="kiosk-action">

                    <span>
                        Mulai Registrasi
                    </span>

                    <span
                        class="kiosk-action-icon"
                        aria-hidden="true">

                        <i
                            class="bi bi-arrow-right">
                        </i>

                    </span>

                </a>

                <div class="kiosk-footer">

                    <i
                        class="bi bi-shield-check"
                        aria-hidden="true">
                    </i>

                    <span>
                        Data Anda diproses dengan aman
                    </span>

                </div>


            </section>

        </div>

    </main>


</body>

</html>