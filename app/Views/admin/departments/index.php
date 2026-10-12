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
            Bagian/Departemen
        </h1>

        <p class="dashboard-subheading">
            Kelola data bagian/departemen dan jumlah pegawai.
        </p>

    </div>

    <div class="dashboard-header-actions">

        <a
            href="<?= base_url('admin/bukutamu-departemen' . ($showDeleted ? '' : '?show_deleted=1')) ?>"
            class="dashboard-secondary-button">

            <i class="bi bi-<?= $showDeleted ? 'arrow-left' : 'trash' ?>"></i>

            <?= $showDeleted ? 'Kembali ke Data Aktif' : 'Tampilkan Terhapus' ?>

        </a>

        <?php if (! $showDeleted): ?>

            <button
                type="button"
                class="dashboard-primary-button"
                id="openTambahDepartemen"
                data-modal-url="<?= base_url('admin/bukutamu-departemen/tambah') ?>">

                <i class="bi bi-plus-lg"></i>

                Tambah Bagian/Departemen

            </button>

        <?php endif; ?>

    </div>

</div>


<div class="glass-card employee-filter-card mb-4">

    <form
        id="departmentFilterForm"
        action="<?= base_url('admin/bukutamu-departemen') ?>"
        method="get"
        class="row g-3 align-items-end">

        <div class="col-12 col-lg-7">

            <label
                for="departmentSearch"
                class="employee-filter-label">

                Cari Bagian/Departemen

            </label>

            <div class="employee-search-wrapper">

                <i class="bi bi-search employee-search-icon"></i>

                <input
                    type="search"
                    id="departmentSearch"
                    name="search"
                    class="form-control employee-filter-input"
                    placeholder="Cari nama bagian/departemen..."
                    value="<?= esc($search ?? '') ?>">

            </div>

        </div>


        <div class="col-12 col-md-6 col-lg-3">

            <label
                for="departmentStatus"
                class="employee-filter-label">

                Status

            </label>

            <select
                id="departmentStatus"
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
                id="resetDepartmentFilter"
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
    id="departmentTableContainer">

    <?= $this->include('components/departments/table', [
        'departments' => $departments,
        'showDeleted' => $showDeleted ?? false,
    ]) ?>

</div>

<div
    class="employee-modal-overlay"
    id="departmentModalOverlay"
    aria-hidden="true">

    <div class="employee-modal-overlay-backdrop"></div>

    <div
        class="employee-modal-container"
        id="departmentModalContainer">
    </div>

</div>


<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/department.js') ?>"></script>

<?= $this->endSection() ?>