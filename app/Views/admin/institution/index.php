<?= $this->extend('layouts/dashboard.php') ?>

<?= $this->section('pageCss') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/institution.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid px-0">

    <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h4 mb-1 fw-semibold institution-page-title">
                Identitas Institusi
            </h1>

            <p class="mb-0 text-muted small">
                Kelola informasi identitas institusi yang digunakan pada sistem.
            </p>
        </div>

        <button
            type="button"
            class="btn glass-button-primary rounded-pill px-4"
            id="openInstitutionEdit"
            data-modal-url="<?= base_url('admin/bukutamu-identitas-institusi/edit') ?>">
            <i class="bi bi-pencil-square me-2" aria-hidden="true"></i>
            Edit Data Identitas Institusi
        </button>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert employee-success-alert glass-card mb-4" role="alert">
            <i class="bi bi-check-circle-fill" aria-hidden="true"></i>

            <span>
                <?= esc(session()->getFlashdata('success')) ?>
            </span>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert employee-error-alert glass-card mb-4" role="alert">
            <i class="bi bi-exclamation-circle-fill" aria-hidden="true"></i>

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
                Data identitas institusi belum tersedia
            </h2>

            <p class="text-muted small mb-0">
                Belum ada data institusi aktif yang dapat ditampilkan.
            </p>
        </div>

    <?php else: ?>

        <div class="row g-4">

            <div class="col-12 col-xl-4">

                <div class="glass-card h-100 p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="employee-modal-icon">
                            <i class="bi bi-image" aria-hidden="true"></i>
                        </div>

                        <div>
                            <h2 class="h6 fw-semibold mb-1">
                                Logo Institusi
                            </h2>

                            <p class="text-muted small mb-0">
                                Logo yang digunakan oleh institusi.
                            </p>
                        </div>
                    </div>

                    <div class="institution-logo-preview">

                        <?php if (!empty($institution['logo'])): ?>

                            <img
                                src="<?= base_url($institution['logo']) ?>"
                                alt="Logo <?= esc($institution['name']) ?>"
                                class="institution-logo-image">

                        <?php else: ?>

                            <div class="institution-logo-placeholder">
                                <i
                                    class="bi bi-building"
                                    aria-hidden="true"></i>

                                <span>
                                    Logo belum tersedia
                                </span>
                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

            <div class="col-12 col-xl-8">

                <div class="glass-card h-100 p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">
                        <div class="employee-modal-icon">
                            <i class="bi bi-building" aria-hidden="true"></i>
                        </div>

                        <div>
                            <h2 class="h6 fw-semibold mb-1">
                                Informasi Institusi
                            </h2>

                            <p class="text-muted small mb-0">
                                Informasi utama institusi.
                            </p>
                        </div>
                    </div>

                    <div class="row g-4">

                        <div class="col-12">

                            <div class="institution-info-item">

                                <span class="institution-info-label">
                                    Nama Instansi
                                </span>

                                <div class="institution-info-value">
                                    <?= esc($institution['name']) ?>
                                </div>

                            </div>

                        </div>

                        <div class="col-12">

                            <div class="institution-info-item">

                                <span class="institution-info-label">
                                    Alamat
                                </span>

                                <div class="institution-info-value institution-info-address">
                                    <?= nl2br(esc($institution['address'] ?? '-')) ?>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="institution-info-item">

                                <span class="institution-info-label">
                                    Nomor Telepon
                                </span>

                                <div class="institution-info-value">
                                    <?= esc($institution['phone'] ?: '-') ?>
                                </div>

                            </div>

                        </div>

                        <div class="col-12 col-md-6">

                            <div class="institution-info-item">

                                <span class="institution-info-label">
                                    Email
                                </span>

                                <div class="institution-info-value">
                                    <?= esc($institution['email'] ?: '-') ?>
                                </div>

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
    id="institutionModalOverlay"
    aria-hidden="true">
    <div class="employee-modal-overlay-backdrop"></div>

    <div
        class="employee-modal-container"
        id="institutionModalContainer"></div>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/institution.js') ?>"></script>

<?= $this->endSection() ?>