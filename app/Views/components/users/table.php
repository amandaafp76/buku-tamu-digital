<div class="table-responsive">

    <table class="user-table align-middle mb-0">

        <thead>

            <tr>

                <th class="user-table-no">
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

            <?php if (! empty($users)): ?>

                <?php
                $no = 1 + (($pager->getCurrentPage() - 1) * 10);
                ?>

                <?php foreach ($users as $user): ?>

                    <tr>

                        <td class="user-table-no">
                            <?= $no++ ?>
                        </td>


                        <td>

                            <div class="user-table-profile">

                                <div class="user-table-avatar">

                                    <i class="bi bi-person"></i>

                                </div>

                                <div class="user-table-name">

                                    <?= esc($user['username']) ?>

                                </div>

                            </div>

                        </td>


                        <td>

                            <?php if ($user['role'] === 'administrator'): ?>

                                <span class="user-role-badge user-role-badge--admin">

                                    <i class="bi bi-shield-check"></i>

                                    Administrator

                                </span>

                            <?php else: ?>

                                <span class="user-role-badge user-role-badge--petugas">

                                    <i class="bi bi-person-badge"></i>

                                    Petugas

                                </span>

                            <?php endif; ?>

                        </td>


                        <td>

                            <?php if ((bool) $user['active']): ?>

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
                                <span class="user-table-deleted-at">
                                    <?= esc($user['deleted_at'] ?? '-') ?>
                                </span>
                            </td>

                        <?php endif; ?>


                        <td>

                            <div class="employee-table-actions">

                                <?php if (! empty($showDeleted)): ?>

                                    <form
                                        action="<?= base_url('admin/bukutamu-pengguna/restore/' . $user['id']) ?>"
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
                                                Pulihkan <?= esc($user['username']) ?>
                                            </span>

                                        </button>

                                    </form>

                                <?php else: ?>

                                    <button
                                        type="button"
                                        class="employee-action-button"
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
                                        class="employee-action-button employee-action-button--warning"
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
                                            class="employee-action-button"
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
                                        class="employee-action-button employee-action-button--danger"
                                        data-user-action="delete"
                                        data-user-delete-url="<?= base_url('admin/bukutamu-pengguna/hapus/' . $user['id']) ?>"
                                        title="Hapus">

                                        <i class="bi bi-trash"></i>

                                        <span class="visually-hidden">
                                            Hapus <?= esc($user['username']) ?>
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

                            <i class="bi bi-people"></i>

                            <p>Belum ada data pengguna.</p>

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