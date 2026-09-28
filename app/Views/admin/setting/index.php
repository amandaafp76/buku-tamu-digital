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
                Konfigurasi Sistem
            </h1>

            <p class="mb-0 text-muted small">
                Kelola pengaturan utama yang digunakan dalam sistem buku tamu.
            </p>
        </div>

        <?php if ($institution): ?>

            <button
                type="button"
                class="btn glass-button-primary rounded-pill px-4"
                id="openSettingEdit"
                data-modal-url="<?= base_url('admin/bukutamu-konfigurasi/edit') ?>">
                <i
                    class="bi bi-pencil-square me-2"
                    aria-hidden="true"></i>

                Edit Konfigurasi Sistem
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
                Konfigurasi sistem belum dapat ditampilkan karena
                belum ada institusi aktif.
            </p>

        </div>


    <?php elseif (!$setting): ?>

        <div class="glass-card p-4 p-lg-5 text-center">

            <div class="mb-3">
                <i
                    class="bi bi-sliders2"
                    style="font-size: 2rem; color: var(--color-primary);"
                    aria-hidden="true"></i>
            </div>

            <h2 class="h6 fw-semibold mb-2">
                Konfigurasi sistem belum tersedia
            </h2>

            <p class="text-muted small mb-4">
                Belum ada konfigurasi sistem untuk
                <?= esc($institution['name']) ?>.
            </p>

            <button
                type="button"
                class="btn glass-button-primary rounded-pill px-4"
                id="openSettingEditEmpty"
                data-modal-url="<?= base_url('admin/bukutamu-konfigurasi/edit') ?>">
                <i
                    class="bi bi-plus-circle me-2"
                    aria-hidden="true"></i>

                Atur Konfigurasi Sistem
            </button>

        </div>


    <?php else: ?>

        <div class="row g-4">

            <div class="col-12 col-xl-6">

                <div class="glass-card h-100 p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">

                        <div class="employee-modal-icon">
                            <i
                                class="bi bi-palette"
                                aria-hidden="true"></i>
                        </div>

                        <div>
                            <h2 class="h6 fw-semibold mb-1">
                                Tampilan
                            </h2>

                            <p class="text-muted small mb-0">
                                Pengaturan tampilan utama sistem.
                            </p>
                        </div>

                    </div>


                    <div class="setting-info-item">

                        <span class="setting-info-label">
                            Warna Utama
                        </span>

                        <div class="setting-color-value">

                            <span
                                class="setting-color-preview"
                                style="background-color: <?= esc($setting['primary_color']) ?>;"
                                aria-hidden="true"></span>

                            <span class="setting-info-value">
                                <?= esc($setting['primary_color']) ?>
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-12 col-xl-6">

                <div class="glass-card h-100 p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">

                        <div class="employee-modal-icon">
                            <i
                                class="bi bi-shield-check"
                                aria-hidden="true"></i>
                        </div>

                        <div>
                            <h2 class="h6 fw-semibold mb-1">
                                Validasi Kunjungan
                            </h2>

                            <p class="text-muted small mb-0">
                                Persyaratan yang harus dipenuhi tamu.
                            </p>
                        </div>

                    </div>


                    <div class="row g-3">

                        <div class="col-12">

                            <div class="setting-info-item">

                                <span class="setting-info-label">
                                    Wajib Foto
                                </span>

                                <span class="setting-status-badge <?= (int) $setting['require_photo'] === 1 ? 'is-active' : 'is-inactive' ?>">
                                    <i
                                        class="bi <?= (int) $setting['require_photo'] === 1 ? 'bi-check-circle-fill' : 'bi-x-circle-fill' ?>"
                                        aria-hidden="true"></i>

                                    <?= (int) $setting['require_photo'] === 1 ? 'Ya' : 'Tidak' ?>
                                </span>

                            </div>

                        </div>


                        <div class="col-12">

                            <div class="setting-info-item">

                                <span class="setting-info-label">
                                    Wajib Tanda Tangan
                                </span>

                                <span class="setting-status-badge <?= (int) $setting['require_signature'] === 1 ? 'is-active' : 'is-inactive' ?>">
                                    <i
                                        class="bi <?= (int) $setting['require_signature'] === 1 ? 'bi-check-circle-fill' : 'bi-x-circle-fill' ?>"
                                        aria-hidden="true"></i>

                                    <?= (int) $setting['require_signature'] === 1 ? 'Ya' : 'Tidak' ?>
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-12 col-xl-6">

                <div class="glass-card h-100 p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">

                        <div class="employee-modal-icon">
                            <i
                                class="bi bi-camera"
                                aria-hidden="true"></i>
                        </div>

                        <div>
                            <h2 class="h6 fw-semibold mb-1">
                                Pengaturan Foto
                            </h2>

                            <p class="text-muted small mb-0">
                                Batas ukuran file foto tamu.
                            </p>
                        </div>

                    </div>


                    <div class="setting-info-item">

                        <span class="setting-info-label">
                            Ukuran Foto
                        </span>

                        <span class="setting-info-value">

                            <?php if ((int) $setting['photo_size'] > 0): ?>

                                <?= esc($setting['photo_size']) ?> KB

                            <?php else: ?>

                                Tidak dibatasi

                            <?php endif; ?>

                        </span>

                    </div>

                </div>

            </div>


            <div class="col-12 col-xl-6">

                <div class="glass-card h-100 p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">

                        <div class="employee-modal-icon">
                            <i
                                class="bi bi-clock-history"
                                aria-hidden="true"></i>
                        </div>

                        <div>
                            <h2 class="h6 fw-semibold mb-1">
                                Peringatan Kunjungan
                            </h2>

                            <p class="text-muted small mb-0">
                                Batas waktu untuk memberikan peringatan.
                            </p>
                        </div>

                    </div>


                    <div class="setting-info-item">

                        <span class="setting-info-label">
                            Batas Peringatan
                        </span>

                        <span class="setting-info-value">

                            <?php if ((int) $setting['warning_limit'] > 0): ?>

                                <?= esc($setting['warning_limit']) ?> menit

                            <?php else: ?>

                                Tidak diaktifkan

                            <?php endif; ?>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    <?php endif; ?>

</div>

<div
    class="employee-modal-overlay"
    id="settingModalOverlay"
    aria-hidden="true">

    <div class="employee-modal-overlay-backdrop"></div>

    <div
        class="employee-modal-container"
        id="settingModalContainer">
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/setting.js') ?>"></script>

<?= $this->endSection() ?>