<div class="table-responsive">

    <table class="visit-purpose-table align-middle mb-0">

        <thead>

            <tr>

                <th class="visit-purpose-table-no">
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

            <?php if (! empty($visitPurposes)): ?>

                <?php
                $no = 1 + (($pager->getCurrentPage() - 1) * 10);
                ?>

                <?php foreach ($visitPurposes as $visitPurpose): ?>

                    <tr>

                        <td class="visit-purpose-table-no">
                            <?= $no++ ?>
                        </td>


                        <td>

                            <div class="visit-purpose-table-name">

                                <?= esc($visitPurpose['purpose_name']) ?>

                            </div>

                        </td>


                        <td class="text-center">

                            <span class="visit-purpose-count-badge">

                                <i class="bi bi-calendar2-check"></i>

                                <?= (int) ($visitPurpose['visit_count'] ?? 0) ?>
                                Kunjungan

                            </span>

                        </td>


                        <td>

                            <?php if ((bool) $visitPurpose['active']): ?>

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
                                <span class="visit-purpose-table-deleted-at">
                                    <?= esc($visitPurpose['deleted_at'] ?? '-') ?>
                                </span>
                            </td>

                        <?php endif; ?>


                        <td>

                            <div class="employee-table-actions">

                                <?php if (! empty($showDeleted)): ?>

                                    <form
                                        action="<?= base_url('admin/bukutamu-tujuan/restore/' . $visitPurpose['id']) ?>"
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
                                                Pulihkan <?= esc($visitPurpose['purpose_name']) ?>
                                            </span>

                                        </button>

                                    </form>

                                <?php else: ?>

                                    <button
                                        type="button"
                                        class="employee-action-button"
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
                                        class="employee-action-button employee-action-button--danger"
                                        data-delete-url="<?= base_url('admin/bukutamu-tujuan/hapus/' . $visitPurpose['id']) ?>"
                                        data-action="delete"
                                        title="Hapus">

                                        <i class="bi bi-trash"></i>

                                        <span class="visually-hidden">
                                            Hapus <?= esc($visitPurpose['purpose_name']) ?>
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

                            <i class="bi bi-signpost-2"></i>

                            <p>Belum ada data tujuan kunjungan.</p>

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