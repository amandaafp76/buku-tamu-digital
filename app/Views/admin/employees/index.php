<?= $this->extend('layouts/dashboard.php') ?>

<?= $this->section('pageCss') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/dashboard.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="visit-page">

    <?php $success = session()->getFlashdata('success'); ?>

    <?php if ($success): ?>

        <div class="alert employee-success-alert glass-card border-0 mb-4" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>

                <span>
                    <?= esc($success) ?>
                </span>
            </div>
        </div>

    <?php endif; ?>

    <div class="dashboard-header mb-4">
        <div class="dashboard-header-text">
            <div>
                <h1 class="dashboard-heading">
                    Pegawai
                </h1>
                <p class="dashboard-subheading">
                    Kelola data pegawai dan bagian/departemen.
                </p>
            </div>

            <div class="dashboard-header-actions">
                <a
                    href="<?= base_url('admin/bukutamu-pegawai' . ($showDeleted ? '' : '?show_deleted=1')) ?>"
                    class="dashboard-secondary-button">
                    <i class="bi bi-<?= $showDeleted ? 'arrow-left' : 'trash' ?>"></i>
                    <?= $showDeleted ? 'Kembali ke Data Aktif' : 'Tampilkan Terhapus' ?>
                </a>

                <?php if (! $showDeleted): ?>
                    <button
                        type="button"
                        class="dashboard-primary-button"
                        id="openTambahPegawai"
                        data-modal-url="<?= base_url('admin/bukutamu-pegawai/tambah') ?>">
                        <i class="bi bi-plus-lg"></i>
                        Tambah Pegawai
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="glass-card dashboard-panel dashboard-visit-filter mb-4">
        <form
            id="employeeFilterForm"
            action="<?= base_url('admin/bukutamu-pegawai') ?>"
            method="get">
            <div class="row g-3">

                <div class="col-12 col-lg-5">
                    <label for="employeeSearch" class="form-label">
                        Cari Pegawai
                    </label>

                    <div class="employee-search-wrapper">
                        <i class="bi bi-search employee-search-icon"></i>

                        <input
                            type="search"
                            id="employeeSearch"
                            name="search"
                            class="form-control"
                            placeholder="Cari nama atau nomor HP..."
                            value="<?= esc($search ?? '') ?>">
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <label for="employeeDepartment" class="form-label">
                        Bagian/Departemen
                    </label>

                    <select
                        id="employeeDepartment"
                        name="department"
                        class="form-select">

                        <option value="">Semua Departemen</option>

                        <?php foreach ($departments as $item): ?>
                            <option
                                value="<?= esc($item['id']) ?>"
                                <?= (string) ($department ?? '') === (string) $item['id'] ? 'selected' : '' ?>>
                                <?= esc($item['name']) ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-2">
                    <label for="employeeStatus" class="form-label">
                        Status
                    </label>

                    <select
                        id="employeeStatus"
                        name="status"
                        class="form-select">

                        <option value="">Semua Status</option>

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

                <div class="col-12 col-md-2 d-flex align-items-end">

                    <button
                        type="button"
                        id="resetEmployeeFilter"
                        class="btn dashboard-visit-reset w-100"
                        title="Reset filter"
                        aria-label="Reset filter">

                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        <span>Reset</span>

                    </button>

                </div>

            </div>

        </form>
    </div>

    <div
        class="glass-card employee-table-card"
        id="employeeTableContainer">

        <?= $this->include('components/employees/table', [
            'employees' => $employees,
            'showDeleted' => $showDeleted ?? false,
        ]) ?>

    </div>

    <div
        class="employee-modal-overlay"
        id="employeeModalOverlay"
        aria-hidden="true">

        <div class="employee-modal-overlay-backdrop"></div>

        <div
            class="employee-modal-container"
            id="employeeModalContainer">
        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/employee.js') ?>"></script>

<?= $this->endSection() ?>