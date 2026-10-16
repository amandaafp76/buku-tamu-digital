<?= $this->extend('layouts/dashboard.php') ?>

<?= $this->section('pageCss') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/dashboard.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="visit-page">

    <?php $success = session()->getFlashdata('success'); ?>
    <?php $error = session()->getFlashdata('error'); ?>

    <?php if ($success): ?>

        <div
            class="alert employee-success-alert glass-card border-0 mb-4"
            role="alert">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-check-circle-fill"></i>

                <span>
                    <?= esc($success) ?>
                </span>

            </div>

        </div>

    <?php endif; ?>


    <?php if ($error): ?>

        <div
            class="alert employee-error-alert glass-card border-0 mb-4"
            role="alert">

            <div class="d-flex align-items-center gap-2">

                <i class="bi bi-exclamation-triangle-fill"></i>

                <span>
                    <?= esc($error) ?>
                </span>

            </div>

        </div>

    <?php endif; ?>


    <div class="dashboard-header mb-4">

        <div class="dashboard-header-text">

            <div>

                <h1 class="dashboard-heading">
                    Tujuan Kunjungan
                </h1>

                <p class="dashboard-subheading">
                    Kelola data tujuan kunjungan dan jumlah kunjungan.
                </p>

            </div>

            <div class="dashboard-header-actions">

                <a
                    href="<?= base_url('admin/bukutamu-tujuan' . ($showDeleted ? '' : '?show_deleted=1')) ?>"
                    class="dashboard-secondary-button">

                    <i class="bi bi-<?= $showDeleted ? 'arrow-left' : 'trash' ?>"></i>

                    <?= $showDeleted ? 'Kembali ke Data Aktif' : 'Tampilkan Terhapus' ?>

                </a>

                <?php if (! $showDeleted): ?>

                    <button
                        type="button"
                        class="dashboard-primary-button"
                        id="openTambahTujuanKunjungan"
                        data-modal-url="<?= base_url('admin/bukutamu-tujuan/tambah') ?>">

                        <i class="bi bi-plus-lg"></i>

                        Tambah Tujuan Kunjungan

                    </button>

                <?php endif; ?>

            </div>

        </div>

    </div>


    <div class="glass-card dashboard-panel dashboard-visit-filter mb-4">

        <form
            id="visitPurposeFilterForm"
            action="<?= base_url('admin/bukutamu-tujuan') ?>"
            method="get">
            <div class="row g-3">

                <div class="col-12 col-lg-7">

                    <label
                        for="purposeSearch"
                        class="employee-filter-label">

                        Cari Tujuan Kunjungan

                    </label>

                    <div class="employee-search-wrapper">

                        <i class="bi bi-search employee-search-icon"></i>

                        <input
                            type="search"
                            id="purposeSearch"
                            name="search"
                            class="form-control employee-filter-input"
                            placeholder="Cari nama tujuan kunjungan..."
                            value="<?= esc($search ?? '') ?>">

                    </div>

                </div>


                <div class="col-12 col-md-6 col-lg-3">

                    <label
                        for="purposeStatus"
                        class="employee-filter-label">

                        Status

                    </label>

                    <select
                        id="purposeStatus"
                        name="status"
                        class="form-select employee-filter-input">

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="aktif"
                            <?= ($status ?? '') === 'aktif' ? 'selected' : '' ?>>

                            Aktif

                        </option>

                        <option
                            value="nonaktif"
                            <?= ($status ?? '') === 'nonaktif' ? 'selected' : '' ?>>

                            Nonaktif

                        </option>

                    </select>

                </div>


                <div class="col-12 col-md-6 col-lg-2 d-flex gap-2">

                    <button
                        type="button"
                        id="resetVisitPurposeFilter"
                        class="btn dashboard-visit-reset w-100"
                        title="Reset filter"
                        aria-label="Reset filter">

                        <i class="bi bi-arrow-counterclockwise"></i>
                        <span>Reset</span>

                    </button>

                </div>

            </div>

        </form>

    </div>


    <div
        class="glass-card employee-table-card"
        id="visitPurposeTableContainer">

        <?= $this->include('components/visit_purposes/table', [
            'visitPurposes' => $visitPurposes,
            'showDeleted'   => $showDeleted ?? false,
        ]) ?>

    </div>


    <div
        class="employee-modal-overlay"
        id="visitPurposeModalOverlay"
        aria-hidden="true">

        <div class="employee-modal-overlay-backdrop"></div>

        <div
            class="employee-modal-container"
            id="visitPurposeModalContainer">
        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/visit_purpose.js') ?>"></script>

<?= $this->endSection() ?>