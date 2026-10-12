<?= $this->extend('layouts/kiosk') ?>

<?= $this->section('pageCss') ?>
<style>
    html,
    body {
        min-height: 100%;
        height: auto;
        overflow-x: hidden;
        overflow-y: auto;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

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

<?= $this->endSection() ?>