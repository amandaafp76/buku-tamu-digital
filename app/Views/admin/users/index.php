<?= $this->extend('layouts/dashboard.php') ?>

<?= $this->section('content') ?>

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

    <div>

        <h1 class="dashboard-heading">
            Pengguna
        </h1>

        <p class="dashboard-subheading">
            Kelola akun pengguna, role, dan status akses sistem.
        </p>

    </div>

    <div class="dashboard-header-actions">

        <a
            href="<?= base_url('admin/bukutamu-pengguna' . ($showDeleted ? '' : '?show_deleted=1')) ?>"
            class="dashboard-secondary-button">

            <i class="bi bi-<?= $showDeleted ? 'arrow-left' : 'trash' ?>"></i>

            <?= $showDeleted ? 'Kembali ke Data Aktif' : 'Tampilkan Terhapus' ?>

        </a>

        <?php if (! $showDeleted): ?>

            <button
                type="button"
                class="dashboard-primary-button"
                id="openTambahPengguna"
                data-modal-url="<?= base_url('admin/bukutamu-pengguna/tambah') ?>">

                <i class="bi bi-plus-lg"></i>

                Tambah Pengguna

            </button>

        <?php endif; ?>

    </div>

</div>


<div class="glass-card employee-filter-card mb-4">

    <form
        id="userFilterForm"
        action="<?= base_url('admin/bukutamu-pengguna') ?>"
        method="get"
        class="row g-3 align-items-end">

        <div class="col-12 col-lg-5">

            <label
                for="userSearch"
                class="employee-filter-label">

                Cari Pengguna

            </label>

            <div class="employee-search-wrapper">

                <i class="bi bi-search employee-search-icon"></i>

                <input
                    type="search"
                    id="userSearch"
                    name="search"
                    class="form-control employee-filter-input"
                    placeholder="Cari username..."
                    value="<?= esc($search ?? '') ?>">

            </div>

        </div>


        <div class="col-12 col-md-6 col-lg-3">

            <label
                for="userRole"
                class="employee-filter-label">

                Role

            </label>

            <select
                id="userRole"
                name="role"
                class="form-select employee-filter-input">

                <option value="">
                    Semua Role
                </option>

                <option
                    value="administrator"
                    <?= ($role ?? '') === 'administrator' ? 'selected' : '' ?>>

                    Administrator

                </option>

                <option
                    value="petugas"
                    <?= ($role ?? '') === 'petugas' ? 'selected' : '' ?>>

                    Petugas

                </option>

            </select>

        </div>

        <div class="col-12 col-md-6 col-lg-2">

            <label
                for="userStatus"
                class="employee-filter-label">

                Status

            </label>

            <select
                id="userStatus"
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
                id="resetUserFilter"
                class="employee-filter-reset"
                title="Reset filter"
                aria-label="Reset filter">

                <i class="bi bi-arrow-counterclockwise"></i>
                <span>Reset</span>

            </button>

        </div>

    </form>

</div>


<div
    class="glass-card employee-table-card"
    id="userTableContainer">

    <?= $this->include('components/users/table', [
        'users' => $users,
        'showDeleted' => $showDeleted ?? false,
    ]) ?>

</div>

<div
    class="employee-modal-overlay"
    id="userModalOverlay"
    aria-hidden="true">

    <div class="employee-modal-overlay-backdrop"></div>

    <div
        class="employee-modal-container"
        id="userModalContainer">
    </div>

</div>


<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/user.js') ?>"></script>

<?= $this->endSection() ?>