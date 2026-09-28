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


<div
    class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

    <div>

        <h1 class="h4 fw-semibold mb-1">
            Pengguna
        </h1>

        <p class="text-secondary mb-0">
            Kelola akun pengguna, role, dan status akses sistem.
        </p>

    </div>


    <button
        type="button"
        class="btn btn-primary glass-button-primary rounded-pill px-4"
        id="openTambahPengguna"
        data-modal-url="<?= base_url('admin/bukutamu-pengguna/tambah') ?>">

        <i class="bi bi-plus-lg me-1"></i>

        Tambah Pengguna

    </button>

</div>


<div class="glass-card employee-filter-card mb-4">

    <form
        action="<?= base_url('admin/bukutamu-pengguna') ?>"
        method="get"
        class="row g-3 align-items-end">

        <div class="col-12 col-lg-5">

            <label
                for="userSearch"
                class="form-label">

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
                class="form-label">

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
                class="form-label">

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
                type="submit"
                class="btn glass-button-primary rounded-pill flex-grow-1">

                <i class="bi bi-search me-1"></i>

                Cari

            </button>


            <a
                href="<?= base_url('admin/bukutamu-pengguna') ?>"
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
                        Username
                    </th>

                    <th>
                        Role
                    </th>

                    <th>
                        Status
                    </th>

                    <th class="text-end">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                <?php if (! empty($users)): ?>

                    <?php foreach ($users as $index => $user): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>


                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div class="employee-avatar">

                                        <i class="bi bi-person"></i>

                                    </div>

                                    <div>

                                        <div class="fw-semibold">

                                            <?= esc($user['username']) ?>

                                        </div>

                                    </div>

                                </div>

                            </td>


                            <td>

                                <?php if ($user['role'] === 'administrator'): ?>

                                    <span
                                        class="badge rounded-pill bg-primary-subtle text-primary-emphasis">

                                        <i class="bi bi-shield-check me-1"></i>

                                        Administrator

                                    </span>

                                <?php else: ?>

                                    <span
                                        class="badge rounded-pill bg-light text-dark">

                                        <i class="bi bi-person-badge me-1"></i>

                                        Petugas

                                    </span>

                                <?php endif; ?>

                            </td>


                            <td>

                                <?php if ((bool) $user['active']): ?>

                                    <span
                                        class="badge rounded-pill bg-success-subtle text-success-emphasis">

                                        Aktif

                                    </span>

                                <?php else: ?>

                                    <span
                                        class="badge rounded-pill bg-secondary-subtle text-secondary">

                                        Nonaktif

                                    </span>

                                <?php endif; ?>

                            </td>


                            <td>

                                <div
                                    class="d-flex justify-content-end gap-2 flex-wrap">

                                    <button
                                        type="button"
                                        class="btn btn-sm employee-action-button"
                                        data-user-action="edit"
                                        data-user-edit-url="<?= base_url('admin/bukutamu-pengguna/edit/' . $user['id']) ?>"
                                        title="Edit">
                                        <i class="bi bi-pencil"></i>
                                        <span class="visually-hidden">
                                            Edit <?= esc($user['username']) ?>
                                        </span>
                                    </button>


                                    <button
                                        type="button"
                                        class="btn btn-sm employee-action-button"
                                        data-reset-password-url="<?= base_url('admin/bukutamu-pengguna/reset-password/' . $user['id']) ?>"
                                        data-action="reset-password"
                                        title="Reset Password">

                                        <i class="bi bi-key"></i>

                                        <span class="visually-hidden">
                                            Reset password <?= esc($user['username']) ?>
                                        </span>

                                    </button>


                                    <form
                                        action="<?= base_url('admin/bukutamu-pengguna/status/' . $user['id']) ?>"
                                        method="post"
                                        class="d-inline">

                                        <?= csrf_field() ?>

                                        <button
                                            type="submit"
                                            class="btn btn-sm employee-action-button"
                                            title="<?= (bool) $user['active'] ? 'Nonaktifkan' : 'Aktifkan' ?>"
                                            aria-label="<?= (bool) $user['active'] ? 'Nonaktifkan' : 'Aktifkan' ?>">

                                            <?php if ((bool) $user['active']): ?>

                                                <i class="bi bi-person-dash"></i>

                                            <?php else: ?>

                                                <i class="bi bi-person-check"></i>

                                            <?php endif; ?>

                                        </button>

                                    </form>

                                    <button
                                        type="button"
                                        class="btn btn-sm employee-action-button employee-delete-button"
                                        data-user-action="delete"
                                        data-user-delete-url="<?= base_url('admin/bukutamu-pengguna/hapus/' . $user['id']) ?>"
                                        title="Hapus">

                                        <i class="bi bi-trash"></i>

                                        <span class="visually-hidden">
                                            Hapus <?= esc($user['username']) ?>
                                        </span>

                                    </button>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="5"
                            class="text-center py-5">

                            <div class="text-secondary">

                                <i
                                    class="bi bi-people fs-3 d-block mb-2">
                                </i>

                                Belum ada data pengguna.

                            </div>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

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