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
                    Daftar Kunjungan
                </h1>

                <p class="dashboard-subheading">
                    Melihat dan mengelola data kunjungan tamu.
                </p>

            </div>

            <div class="dashboard-header-actions">

                <a
                    href="<?= site_url('admin/bukutamu-kunjungan' . ($showDeleted ? '' : '?show_deleted=1')) ?>"
                    class="dashboard-secondary-button">

                    <i class="bi bi-<?= $showDeleted ? 'arrow-left' : 'trash' ?>"></i>

                    <?= $showDeleted ? 'Kembali ke Data Aktif' : 'Tampilkan Terhapus' ?>

                </a>

            </div>

        </div>

    </div>

    <div class="glass-card dashboard-panel dashboard-visit-filter mb-4">

        <form
            id="kunjunganFilterForm"
            action="<?= site_url('admin/bukutamu-kunjungan') ?>"
            method="get">
            <div class="row g-3">

                <div class="col-12 col-lg-5">

                    <label
                        for="kunjunganKeyword"
                        class="employee-filter-label">

                        Cari Kunjungan

                    </label>

                    <div class="employee-search-wrapper">

                        <i class="bi bi-search employee-search-icon"></i>

                        <input
                            type="search"
                            id="kunjunganKeyword"
                            name="keyword"
                            class="form-control employee-filter-input"
                            value="<?= esc($keyword ?? '') ?>"
                            placeholder="Nama, kode, nomor HP, bagian, atau pegawai">

                    </div>

                </div>


                <div class="col-12 col-md-6 col-lg-3">

                    <label
                        for="kunjunganStatus"
                        class="employee-filter-label">

                        Status

                    </label>

                    <select
                        id="kunjunganStatus"
                        name="status"
                        class="form-select employee-filter-input">

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="Menunggu"
                            <?= ($status ?? '') === 'Menunggu' ? 'selected' : '' ?>>
                            Menunggu
                        </option>

                        <option
                            value="Masih Berkunjung"
                            <?= ($status ?? '') === 'Masih Berkunjung' ? 'selected' : '' ?>>
                            Masih Berkunjung
                        </option>

                        <option
                            value="Selesai"
                            <?= ($status ?? '') === 'Selesai' ? 'selected' : '' ?>>
                            Selesai
                        </option>

                        <option
                            value="Ditolak"
                            <?= ($status ?? '') === 'Ditolak' ? 'selected' : '' ?>>
                            Ditolak
                        </option>

                        <option
                            value="Dibatalkan"
                            <?= ($status ?? '') === 'Dibatalkan' ? 'selected' : '' ?>>
                            Dibatalkan
                        </option>

                    </select>

                </div>


                <div class="col-12 col-md-6 col-lg-2">

                    <label
                        for="kunjunganDate"
                        class="employee-filter-label">

                        Tanggal

                    </label>

                    <input
                        type="date"
                        id="kunjunganDate"
                        name="date"
                        class="form-control employee-filter-input"
                        value="<?= esc($date ?? '') ?>">

                </div>


                <div class="col-12 col-md-6 col-lg-2 d-flex gap-2">

                    <button
                        type="button"
                        id="resetKunjunganFilter"
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
        class="glass-card p-4"
        id="kunjunganTableContainer">

        <?= $this->include('components/kunjungan/table', [
            'showDeleted' => $showDeleted ?? false,
        ]) ?>

    </div>


    <div
        class="employee-modal-overlay"
        id="visitModalOverlay"
        aria-hidden="true">

        <div class="employee-modal-overlay-backdrop"></div>

        <div
            class="employee-modal-container"
            id="visitModalContainer">
        </div>

    </div>

</div>


<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/kunjungan.js') ?>"></script>

<?= $this->endSection() ?>