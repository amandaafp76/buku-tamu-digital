<?= $this->extend('layouts/dashboard.php') ?>

<?= $this->section('content') ?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

    <div>
        <h1 class="h4 fw-semibold mb-1">
            Activity Log
        </h1>

        <p class="text-secondary mb-0">
            Riwayat aktivitas pengguna dalam sistem.
        </p>
    </div>

</div>


<div class="glass-card employee-filter-card mb-4">

    <form
        action="<?= base_url('admin/bukutamu-activity-log') ?>"
        method="get"
        class="row g-3 align-items-end">

        <div class="col-12 col-lg-5">

            <label
                for="activityLogSearch"
                class="form-label">

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
                class="form-label">

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
                class="form-label">

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


        <div class="col-12 col-lg-2 d-flex gap-2">

            <button
                type="submit"
                class="btn glass-button-primary rounded-pill flex-grow-1">

                <i class="bi bi-search me-1"></i>
                Cari

            </button>

            <a
                href="<?= base_url('admin/bukutamu-activity-log') ?>"
                class="btn btn-light rounded-pill"
                title="Reset filter"
                aria-label="Reset filter">

                <i class="bi bi-arrow-counterclockwise"></i>

            </a>

        </div>

    </form>

</div>


<div class="glass-card employee-table-card">

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead>

                <tr>

                    <th style="width: 70px;">
                        No
                    </th>

                    <th>
                        Waktu
                    </th>

                    <th>
                        Pengguna
                    </th>

                    <th>
                        Aksi
                    </th>

                    <th>
                        Data
                    </th>

                    <th>
                        Aktivitas
                    </th>

                </tr>

            </thead>


            <tbody>

                <?php if (! empty($activityLogs)): ?>

                    <?php foreach ($activityLogs as $index => $log): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>


                            <td>

                                <div class="fw-semibold">
                                    <?= esc($log['created_at'] ?? '-') ?>
                                </div>

                            </td>


                            <td>

                                <div class="fw-semibold">
                                    <?= esc($log['username'] ?? '-') ?>
                                </div>

                            </td>


                            <td>

                                <?php
                                $action = strtolower(
                                    (string) ($log['action'] ?? '')
                                );
                                ?>

                                <?php if ($action === 'create'): ?>

                                    <span class="badge rounded-pill bg-success-subtle text-success-emphasis">
                                        Tambah
                                    </span>

                                <?php elseif ($action === 'update'): ?>

                                    <span class="badge rounded-pill bg-primary-subtle text-primary-emphasis">
                                        Perbarui
                                    </span>

                                <?php elseif ($action === 'delete'): ?>

                                    <span class="badge rounded-pill bg-danger-subtle text-danger-emphasis">
                                        Hapus
                                    </span>
                                <?php elseif ($action === 'restore'): ?>

                                    <span class="badge rounded-pill bg-warning-subtle text-warning-emphasis">
                                        Pulihkan
                                    </span>

                                <?php elseif ($action === 'login'): ?>

                                    <span class="badge rounded-pill bg-info-subtle text-info-emphasis">
                                        Login
                                    </span>

                                <?php elseif ($action === 'logout'): ?>

                                    <span class="badge rounded-pill bg-secondary-subtle text-secondary">
                                        Logout
                                    </span>

                                <?php else: ?>

                                    <span class="badge rounded-pill bg-secondary-subtle text-secondary">
                                        <?= esc($log['action'] ?? '-') ?>
                                    </span>

                                <?php endif; ?>

                            </td>


                            <td>

                                <div class="fw-semibold">
                                    <?= esc($log['entity'] ?? '-') ?>
                                </div>

                                <?php if (! empty($log['entity_id'])): ?>

                                    <small class="text-secondary">
                                        ID #<?= esc($log['entity_id']) ?>
                                    </small>

                                <?php endif; ?>

                            </td>


                            <td>

                                <?= esc($log['activity'] ?? '-') ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-5">

                            <div class="text-secondary">

                                Belum ada aktivitas yang tercatat.

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>