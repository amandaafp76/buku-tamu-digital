<div class="table-responsive">
    <table class="employee-table align-middle mb-0">
        <thead>
            <tr>
                <th class="employee-table-no">No</th>
                <th>Nama Pegawai</th>
                <th>Nomor HP</th>
                <th>Bagian/Departemen</th>
                <th>Status</th>
                <?php if (! empty($showDeleted)): ?>
                    <th>Dihapus Pada</th>
                <?php endif; ?>
                <th class="text-end">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php if (! empty($employees)): ?>

                <?php
                $no = 1 + (($pager->getCurrentPage() - 1) * 10);
                ?>

                <?php foreach ($employees as $employee): ?>

                    <tr>
                        <td class="employee-table-no">
                            <?= $no++ ?>
                        </td>

                        <td>
                            <div class="fw-semibold">
                                <?= esc($employee['employee_name']) ?>
                            </div>
                        </td>

                        <td>
                            <?= esc($employee['phone'] ?? '-') ?>
                        </td>

                        <td>
                            <?= esc($employee['department_name'] ?? '-') ?>
                        </td>

                        <td>
                            <?php if ((bool) $employee['active']): ?>

                                <span class="employee-status-badge employee-status-badge--active">
                                    Aktif
                                </span>

                            <?php else: ?>

                                <span class="employee-status-badge employee-status-badge--inactive">
                                    Nonaktif
                                </span>

                            <?php endif; ?>
                        </td>

                        <?php if (! empty($showDeleted)): ?>
                            <td>
                                <span class="employee-table-deleted-at">
                                    <?= esc($employee['deleted_at'] ?? '-') ?>
                                    </small>
                            </td>
                        <?php endif; ?>

                        <td>
                            <div class="d-flex justify-content-end gap-2">

                                <?php if (! empty($showDeleted)): ?>

                                    <form
                                        action="<?= base_url('admin/bukutamu-pegawai/restore/' . $employee['id']) ?>"
                                        method="post"
                                        class="d-inline"
                                        data-offline-guard>
                                        <?= csrf_field() ?>
                                        <button
                                            type="submit"
                                            class="employee-action-button employee-action-button--success"
                                            title="Pulihkan">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                            <span class="visually-hidden">
                                                Pulihkan <?= esc($employee['employee_name']) ?>
                                            </span>
                                        </button>
                                    </form>

                                <?php else: ?>

                        <td>
                            <div class="employee-table-actions">

                                <button
                                    type="button"
                                    class="employee-action-button"
                                    data-edit-url="<?= base_url('admin/bukutamu-pegawai/edit/' . $employee['id']) ?>"
                                    data-action="edit"
                                    title="Edit">
                                    <i class="bi bi-pencil"></i>
                                    <span class="visually-hidden">
                                        Edit <?= esc($employee['employee_name']) ?>
                                    </span>
                                </button>

                                <button
                                    type="button"
                                    class="employee-action-button employee-action-button--danger"
                                    data-delete-url="<?= base_url('admin/bukutamu-pegawai/hapus/' . $employee['id']) ?>"
                                    data-employee-name="<?= esc($employee['employee_name']) ?>"
                                    data-action="delete"
                                    title="Hapus">
                                    <i class="bi bi-trash"></i>

                                    <span class="visually-hidden">
                                        Hapus <?= esc($employee['employee_name']) ?>
                                    </span>
                                </button>

                            <?php endif; ?>

                            </div>
                        </td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="<?= ! empty($showDeleted) ? 7 : 6 ?>">
                        <div class="employee-table-empty">
                            <i class="bi bi-inbox"></i>
                            Belum ada data pegawai.
                        </div>
                    </td>
                </tr>

            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php if (isset($pager)): ?>

    <div class="admin-pagination mt-3">

        <?= $pager->links() ?>

    </div>

<?php endif; ?>