<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('pageCss') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/dashboard.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="visit-page">

    <div class="dashboard-header mb-4">

        <div class="dashboard-header-text">

            <div>
                <h1 class="dashboard-heading">
                    Daftar Kunjungan
                </h1>

                <p class="dashboard-subheading">
                    Melihat dan mencari data kunjungan tamu.
                </p>

            </div>

        </div>

    </div>


    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger">

            <?= esc(session()->getFlashdata('error')) ?>

        </div>

    <?php endif; ?>


    <div class="glass-card dashboard-panel dashboard-visit-filter mb-4">

        <form
            id="kunjunganFilterForm"
            action="<?= site_url('petugas/bukutamu-kunjungan') ?>"
            method="get">

            <div class="row g-3">

                <div class="col-md-5">

                    <label class="form-label">
                        Cari Kunjungan
                    </label>

                    <input
                        type="text"
                        id="kunjunganKeyword"
                        name="keyword"
                        class="form-control"
                        value="<?= esc($keyword) ?>"
                        placeholder="Nama, kode, nomor HP, bagian, atau pegawai">

                </div>


                <div class="col-md-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        id="kunjunganStatus"
                        name="status"
                        class="form-select">

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="Menunggu"
                            <?= $status === 'Menunggu' ? 'selected' : '' ?>>
                            Menunggu
                        </option>

                        <option
                            value="Masih Berkunjung"
                            <?= $status === 'Masih Berkunjung' ? 'selected' : '' ?>>
                            Masih Berkunjung
                        </option>

                        <option
                            value="Selesai"
                            <?= $status === 'Selesai' ? 'selected' : '' ?>>
                            Selesai
                        </option>

                        <option
                            value="Ditolak"
                            <?= $status === 'Ditolak' ? 'selected' : '' ?>>
                            Ditolak
                        </option>

                        <option
                            value="Dibatalkan"
                            <?= $status === 'Dibatalkan' ? 'selected' : '' ?>>
                            Dibatalkan
                        </option>

                    </select>

                </div>


                <div class="col-md-2">

                    <label class="form-label">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        id="kunjunganDate"
                        name="date"
                        class="form-control"
                        value="<?= esc($date) ?>">

                </div>

                <div class="col-md-2 d-flex align-items-end">

                    <button
                        type="button"
                        id="resetKunjunganFilter"
                        class="btn dashboard-visit-reset w-100">

                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset

                    </button>

                </div>

            </div>

        </form>

    </div>

    <div class="glass-card p-4"
        id="kunjunganTableContainer">

        <?= $this->include('components/kunjungan/table', [
            'detailBaseUrl' => 'petugas/bukutamu-kunjungan',
        ]) ?>

    </div>

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

<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/kunjungan.js') ?>"></script>

<?= $this->endSection() ?>