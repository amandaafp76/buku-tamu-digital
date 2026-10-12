<div class="table-responsive">

    <table class="activity-log-table align-middle mb-0">

        <thead>

            <tr>

                <th class="activity-log-table-no">
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

                    <?php
                    $action = strtolower(
                        (string) ($log['action'] ?? '')
                    );

                    $actionSlug = match ($action) {
                        'create'  => 'create',
                        'update'  => 'update',
                        'delete'  => 'delete',
                        'restore' => 'restore',
                        'login'   => 'login',
                        'logout'  => 'logout',
                        default   => 'default',
                    };

                    $actionLabel = match ($action) {
                        'create'  => 'Tambah',
                        'update'  => 'Perbarui',
                        'delete'  => 'Hapus',
                        'restore' => 'Pulihkan',
                        'login'   => 'Login',
                        'logout'  => 'Logout',
                        default   => $log['action'] ?? '-',
                    };
                    ?>

                    <tr>

                        <td class="activity-log-table-no">
                            <?= (($pager->getCurrentPage() - 1) * 10) + $index + 1 ?>
                        </td>


                        <td>

                            <span class="activity-log-table-time">
                                <?= esc($log['created_at'] ?? '-') ?>
                            </span>

                        </td>


                        <td>

                            <div class="activity-log-table-user">

                                <div class="activity-log-table-avatar">

                                    <i class="bi bi-person"></i>

                                </div>

                                <div class="activity-log-table-username">

                                    <?= esc($log['username'] ?? '-') ?>

                                </div>

                            </div>

                        </td>


                        <td>

                            <span class="activity-log-action-badge activity-log-action-badge--<?= $actionSlug ?>">

                                <?= esc($actionLabel) ?>

                            </span>

                        </td>


                        <td>

                            <div class="activity-log-table-entity">

                                <div class="activity-log-table-entity-name">

                                    <?= esc($log['entity'] ?? '-') ?>

                                </div>

                                <?php if (! empty($log['entity_id'])): ?>

                                    <div class="activity-log-table-entity-id">

                                        ID #<?= esc($log['entity_id']) ?>

                                    </div>

                                <?php endif; ?>

                            </div>

                        </td>


                        <td>

                            <span class="activity-log-table-activity">

                                <?= esc($log['activity'] ?? '-') ?>

                            </span>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="6">

                        <div class="employee-table-empty">

                            <i class="bi bi-clock-history"></i>

                            <p>Belum ada aktivitas yang tercatat.</p>

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