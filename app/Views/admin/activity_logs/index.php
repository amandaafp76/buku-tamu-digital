<?= $this->extend('layouts/dashboard.php') ?>

<?= $this->section('content') ?>

<div class="dashboard-header mb-4">

    <div>

        <h1 class="dashboard-heading">
            Activity Log
        </h1>

        <p class="dashboard-subheading">
            Riwayat aktivitas pengguna dalam sistem.
        </p>

    </div>

</div>


<div class="glass-card employee-filter-card mb-4">

    <form
        id="activityLogFilterForm"
        action="<?= base_url('admin/bukutamu-activity-log') ?>"
        method="get"
        class="row g-3 align-items-end">

        <div class="col-12 col-lg-5">

            <label
                for="activityLogSearch"
                class="employee-filter-label">

                Cari Aktivitas

            </label>

            <div class="employee-search-wrapper">

                <i class="bi bi-search employee-search-icon"></i>

                <input
                    type="search"
                    id="activityLogSearch"
                    name="search"
                    class="form-control employee-filter-input"
                    placeholder="Cari username atau aktivitas..."
                    value="<?= esc($search ?? '') ?>">

            </div>

        </div>


        <div class="col-12 col-md-6 col-lg-3">

            <label
                for="activityLogAction"
                class="employee-filter-label">

                Aksi

            </label>

            <select
                id="activityLogAction"
                name="action"
                class="form-select employee-filter-input">

                <option value="">
                    Semua Aksi
                </option>

                <option
                    value="login"
                    <?= ($action ?? '') === 'login' ? 'selected' : '' ?>>
                    Login
                </option>

                <option
                    value="logout"
                    <?= ($action ?? '') === 'logout' ? 'selected' : '' ?>>
                    Logout
                </option>

                <option
                    value="create"
                    <?= ($action ?? '') === 'create' ? 'selected' : '' ?>>
                    Tambah
                </option>

                <option
                    value="update"
                    <?= ($action ?? '') === 'update' ? 'selected' : '' ?>>
                    Perbarui
                </option>

                <option
                    value="delete"
                    <?= ($action ?? '') === 'delete' ? 'selected' : '' ?>>
                    Hapus
                </option>

                <option
                    value="restore"
                    <?= ($action ?? '') === 'restore' ? 'selected' : '' ?>>
                    Pulihkan
                </option>

            </select>

        </div>


        <div class="col-12 col-md-6 col-lg-2">

            <label
                for="activityLogEntity"
                class="employee-filter-label">

                Data

            </label>

            <select
                id="activityLogEntity"
                name="entity"
                class="form-select employee-filter-input">

                <option value="">
                    Semua Data
                </option>

                <option
                    value="employee"
                    <?= ($entity ?? '') === 'employee' ? 'selected' : '' ?>>
                    Pegawai
                </option>

                <option
                    value="department"
                    <?= ($entity ?? '') === 'department' ? 'selected' : '' ?>>
                    Departemen
                </option>

                <option
                    value="visit_purpose"
                    <?= ($entity ?? '') === 'visit_purpose' ? 'selected' : '' ?>>
                    Tujuan Kunjungan
                </option>

                <option
                    value="user"
                    <?= ($entity ?? '') === 'user' ? 'selected' : '' ?>>
                    Pengguna
                </option>

                <option
                    value="auth"
                    <?= ($entity ?? '') === 'auth' ? 'selected' : '' ?>>
                    Autentikasi
                </option>

            </select>

        </div>


        <div class="col-12 col-md-6 col-lg-2 d-flex gap-2">

            <button
                type="button"
                id="resetActivityLogFilter"
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
    id="activityLogTableContainer">

    <?= $this->include('components/activity_logs/table', [
        'activityLogs' => $activityLogs,
    ]) ?>

</div>

<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/activity_log.js') ?>"></script>

<?= $this->endSection() ?>