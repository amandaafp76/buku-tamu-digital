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
            Tujuan Kunjungan
        </h1>

        <p class="text-secondary mb-0">
            Kelola data tujuan kunjungan dan jumlah kunjungan.
        </p>

    </div>

    <button
        type="button"
        class="btn btn-primary glass-button-primary rounded-pill px-4"
        id="openTambahTujuanKunjungan"
        data-modal-url="<?= base_url('admin/bukutamu-tujuan/tambah') ?>">

        <i class="bi bi-plus-lg me-1"></i>

        Tambah Tujuan Kunjungan

    </button>

</div>


<div class="glass-card employee-filter-card mb-4">

    <form
        action="<?= base_url('admin/bukutamu-tujuan') ?>"
        method="get"
        class="row g-3 align-items-end">

        <div class="col-12 col-lg-7">

            <label
                for="purposeSearch"
                class="form-label">

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
                class="form-label">

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
                type="submit"
                class="btn glass-button-primary rounded-pill flex-grow-1">

                <i class="bi bi-search me-1"></i>

                Cari

            </button>

            <a
                href="<?= base_url('admin/bukutamu-tujuan') ?>"
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
                        Nama Tujuan Kunjungan
                    </th>

                    <th class="text-center">
                        Jumlah Kunjungan
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

                <?php if (! empty($visitPurposes)): ?>

                    <?php foreach ($visitPurposes as $index => $visitPurpose): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>


                            <td>

                                <div class="fw-semibold">

                                    <?= esc($visitPurpose['purpose_name']) ?>

                                </div>

                            </td>


                            <td class="text-center">

                                <span class="badge rounded-pill bg-light text-dark">

                                    <i class="bi bi-calendar2-check me-1"></i>

                                    <?= (int) ($visitPurpose['visit_count'] ?? 0) ?>

                                    Kunjungan

                                </span>

                            </td>


                            <td>

                                <?php if ((bool) $visitPurpose['active']): ?>

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
                                    class="d-flex justify-content-end gap-2">

                                    <button
                                        type="button"
                                        class="btn btn-sm employee-action-button"
                                        data-edit-url="<?= base_url('admin/bukutamu-tujuan/edit/' . $visitPurpose['id']) ?>"
                                        data-action="edit"
                                        title="Edit">

                                        <i class="bi bi-pencil"></i>

                                        <span class="visually-hidden">
                                            Edit <?= esc($visitPurpose['purpose_name']) ?>
                                        </span>

                                    </button>


                                    <button
                                        type="button"
                                        class="btn btn-sm employee-action-button employee-delete-button"
                                        data-delete-url="<?= base_url('admin/bukutamu-tujuan/hapus/' . $visitPurpose['id']) ?>"
                                        data-action="delete"
                                        title="Hapus">

                                        <i class="bi bi-trash"></i>

                                        <span class="visually-hidden">
                                            Hapus <?= esc($visitPurpose['purpose_name']) ?>
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
                                    class="bi bi-signpost-2 fs-3 d-block mb-2">
                                </i>

                                Belum ada data tujuan kunjungan.

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
    id="visitPurposeModalOverlay"
    aria-hidden="true">

    <div class="employee-modal-overlay-backdrop"></div>

    <div
        class="employee-modal-container"
        id="visitPurposeModalContainer">
    </div>

</div>


<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/visit_purpose.js') ?>"></script>

<?= $this->endSection() ?>