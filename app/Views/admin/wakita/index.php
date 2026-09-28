<?= $this->extend('layouts/dashboard.php') ?>

<?= $this->section('pageCss') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/setting.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid px-0">

    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">

        <div>
            <h1 class="h4 mb-1 fw-semibold setting-page-title">
                WAKITA
            </h1>

            <p class="mb-0 text-muted small">
                Kelola status dan konfigurasi koneksi WAKITA.
            </p>
        </div>

        <?php if ($institution && $setting): ?>

            <button
                type="button"
                class="btn glass-button-primary rounded-pill px-4"
                id="openWakitaEdit"
                data-modal-url="<?= base_url('admin/bukutamu-wakita/edit') ?>">

                <i
                    class="bi bi-pencil-square me-2"
                    aria-hidden="true"></i>

                Edit Konfigurasi WAKITA

            </button>

        <?php endif; ?>

    </div>


    <?php if (session()->getFlashdata('success')): ?>

        <div
            class="alert employee-success-alert glass-card mb-4"
            role="alert">

            <i
                class="bi bi-check-circle-fill"
                aria-hidden="true"></i>

            <span>
                <?= esc(session()->getFlashdata('success')) ?>
            </span>

        </div>

    <?php endif; ?>


    <?php if (session()->getFlashdata('error')): ?>

        <div
            class="alert employee-error-alert glass-card mb-4"
            role="alert">

            <i
                class="bi bi-exclamation-circle-fill"
                aria-hidden="true"></i>

            <span>
                <?= esc(session()->getFlashdata('error')) ?>
            </span>

        </div>

    <?php endif; ?>


    <?php if (!$institution): ?>

        <div class="glass-card p-4 p-lg-5 text-center">

            <div class="mb-3">
                <i
                    class="bi bi-building-exclamation"
                    style="font-size: 2rem; color: var(--color-primary);"
                    aria-hidden="true"></i>
            </div>

            <h2 class="h6 fw-semibold mb-2">
                Institusi belum tersedia
            </h2>

            <p class="text-muted small mb-0">
                Konfigurasi WAKITA belum dapat ditampilkan karena
                belum ada institusi aktif.
            </p>

        </div>


    <?php elseif (!$setting): ?>

        <div class="glass-card p-4 p-lg-5 text-center">

            <div class="mb-3">
                <i
                    class="bi bi-chat-square-text"
                    style="font-size: 2rem; color: var(--color-primary);"
                    aria-hidden="true"></i>
            </div>

            <h2 class="h6 fw-semibold mb-2">
                Konfigurasi WAKITA belum tersedia
            </h2>

            <p class="text-muted small mb-4">
                Belum ada konfigurasi sistem untuk
                <?= esc($institution['name']) ?>.
            </p>

            <button
                type="button"
                class="btn glass-button-primary rounded-pill px-4"
                id="openWakitaEditEmpty"
                data-modal-url="<?= base_url('admin/bukutamu-wakita/edit') ?>">

                <i
                    class="bi bi-plus-circle me-2"
                    aria-hidden="true"></i>

                Atur Konfigurasi WAKITA

            </button>

        </div>


    <?php else: ?>

        <div class="row g-4">


            <div class="col-12">

                <div class="glass-card h-100 p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">

                        <div class="employee-modal-icon">
                            <i
                                class="bi bi-power"
                                aria-hidden="true"></i>
                        </div>

                        <div>

                            <h2 class="h6 fw-semibold mb-1">
                                Status WAKITA
                            </h2>

                            <p class="text-muted small mb-0">
                                Aktifkan atau nonaktifkan penggunaan WAKITA.
                            </p>

                        </div>

                    </div>


                    <div class="setting-info-item">

                        <span class="setting-info-label">
                            WAKITA
                        </span>

                        <span
                            class="setting-status-badge <?= (int) $setting['wakita_enabled'] === 1
                                                            ? 'is-active'
                                                            : 'is-inactive' ?>">

                            <i
                                class="bi <?= (int) $setting['wakita_enabled'] === 1
                                                ? 'bi-check-circle-fill'
                                                : 'bi-x-circle-fill' ?>"
                                aria-hidden="true"></i>

                            <?= (int) $setting['wakita_enabled'] === 1
                                ? 'Aktif'
                                : 'Nonaktif' ?>

                        </span>

                    </div>

                </div>

            </div>


            <!-- KONFIGURASI KONEKSI -->

            <div class="col-12">

                <div class="glass-card h-100 p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">

                        <div class="employee-modal-icon">
                            <i
                                class="bi bi-plug"
                                aria-hidden="true"></i>
                        </div>

                        <div>

                            <h2 class="h6 fw-semibold mb-1">
                                Konfigurasi Koneksi
                            </h2>

                            <p class="text-muted small mb-0">
                                Pengaturan koneksi ke layanan WAKITA.
                            </p>

                        </div>

                    </div>


                    <div class="row g-3">


                        <div class="col-12">

                            <div class="setting-info-item">

                                <span class="setting-info-label">
                                    API URL
                                </span>

                                <span class="setting-info-value text-break">
                                    <?= $setting['wakita_api_url']
                                        ? esc($setting['wakita_api_url'])
                                        : 'Belum dikonfigurasi' ?>
                                </span>

                            </div>

                        </div>


                        <div class="col-12">

                            <div class="setting-info-item">

                                <span class="setting-info-label">
                                    API Key
                                </span>

                                <span class="setting-info-value">

                                    <?= !empty($setting['wakita_api_key'])
                                        ? '••••••••••••••••'
                                        : 'Belum dikonfigurasi' ?>

                                </span>

                            </div>

                        </div>


                        <div class="col-12">

                            <div class="setting-info-item">

                                <span class="setting-info-label">
                                    Sender
                                </span>

                                <span class="setting-info-value">

                                    <?= $setting['wakita_sender']
                                        ? esc($setting['wakita_sender'])
                                        : 'Belum dikonfigurasi' ?>

                                </span>

                            </div>

                        </div>


                    </div>

                </div>

            </div>


        </div>

    <?php endif; ?>

</div>


<div
    class="employee-modal-overlay"
    id="wakitaModalOverlay"
    aria-hidden="true">

    <div class="employee-modal-overlay-backdrop"></div>

    <div
        class="employee-modal-container"
        id="wakitaModalContainer">
    </div>

</div>


<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/wakita.js') ?>"></script>

<?= $this->endSection() ?>