<div class="table-responsive">

    <table class="department-table align-middle mb-0">
        <thead>

            <tr>

                <th class="department-table-no">
                    No
                </th>

                <th>
                    Nama Bagian/Departemen
                </th>

                <th class="text-center">
                    Jumlah Pegawai
                </th>

                <th>
                    Status
                </th>

                <?php if (! empty($showDeleted)): ?>
                    <th>
                        Dihapus Pada
                    </th>
                <?php endif; ?>

                <th class="text-end">
                    Aksi
                </th>

            </tr>

        </thead>


        <tbody>

            <?php if (! empty($departments)): ?>

                <?php
                $no = 1 + (($pager->getCurrentPage() - 1) * 10);
                ?>

                <?php foreach ($departments as $department): ?>

                    <tr>

                        <td class="department-table-no">
                            <?= $no++ ?>
                        </td>


                        <td>

                            <div class="department-table-name">

                                <?= esc($department['name']) ?>

                            </div>

                        </td>


                        <td class="text-center">

                            <span class="department-count-badge">

                                <i class="bi bi-people"></i>

                                <?= (int) $department['employee_count'] ?>
                                Pegawai

                            </span>

                        </td>


                        <td>

                            <?php if ((bool) $department['active']): ?>

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
                                <span class="department-table-deleted-at">
                                    <?= esc($department['deleted_at'] ?? '-') ?>
                                </span>
                            </td>

                        <?php endif; ?>


                        <td>

                            <div
                                class="d-flex justify-content-end gap-2">

                                <?php if (! empty($showDeleted)): ?>

                                    <form
                                        action="<?= base_url('admin/bukutamu-departemen/restore/' . $department['id']) ?>"
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
                                                Pulihkan <?= esc($department['name']) ?>
                                            </span>

                                        </button>

                                    </form>

                                <?php else: ?>

                        <td>

                            <div class="employee-table-actions">

                                <button
                                    type="button"
                                    class="employee-action-button"
                                    data-edit-url="<?= base_url('admin/bukutamu-departemen/edit/' . $department['id']) ?>"
                                    data-action="edit"
                                    title="Edit">

                                    <i class="bi bi-pencil"></i>

                                    <span class="visually-hidden">
                                        Edit <?= esc($department['name']) ?>
                                    </span>

                                </button>

                                <button
                                    type="button"
                                    class="employee-action-button employee-action-button--danger"
                                    data-delete-url="<?= base_url('admin/bukutamu-departemen/hapus/' . $department['id']) ?>"
                                    data-action="delete"
                                    title="Hapus">

                                    <i class="bi bi-trash"></i>

                                    <span class="visually-hidden">
                                        Hapus <?= esc($department['name']) ?>
                                    </span>

                                </button>

                            <?php endif; ?>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="<?= ! empty($showDeleted) ? 6 : 5 ?>">

                        <div class="employee-table-empty">

                            <i class="bi bi-building"></i>

                            <p>Belum ada data bagian/departemen.</p>

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