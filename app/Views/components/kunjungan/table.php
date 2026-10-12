<?php

$isAdmin = url_is('admin/bukutamu-kunjungan*');

$isHistoryMode = ! empty($isHistory);

$detailBaseUrl = url_is('admin/bukutamu-kunjungan*')
    ? 'admin/bukutamu-kunjungan'
    : 'petugas/bukutamu-kunjungan';

$showDeletedMode = $isAdmin && ! empty($showDeleted);

?>

<div class="table-responsive">

    <table class="visit-table align-middle mb-0">

        <thead>

            <tr>

                <th class="visit-table-no">
                    No
                </th>

                <th>
                    Kode Kunjungan
                </th>

                <th>
                    Tamu
                </th>

                <th>
                    Tujuan
                </th>

                <th>
                    Waktu
                </th>

                <th>
                    Status
                </th>

                <?php if ($showDeletedMode): ?>
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

            <?php if (! empty($visits)): ?>

                <?php
                $no = 1 + (($pager->getCurrentPage() - 1) * 10);
                ?>

                <?php foreach ($visits as $visit): ?>

                    <?php
                    $durationText = null;

                    if (
                        $visit['status'] === 'Masih Berkunjung'
                        && ! empty($visit['check_in'])
                    ) {
                        $checkIn = new DateTime($visit['check_in']);
                        $now = new DateTime();

                        $interval = $checkIn->diff($now);

                        $parts = [];

                        if ($interval->d > 0) {
                            $parts[] = $interval->d . ' hari';
                        }

                        if ($interval->h > 0) {
                            $parts[] = $interval->h . ' jam';
                        }

                        if ($interval->i > 0) {
                            $parts[] = $interval->i . ' menit';
                        }

                        if (empty($parts)) {
                            $parts[] = 'Baru saja';
                        }

                        $durationText = implode(' ', $parts);
                    }

                    $statusSlug = match ($visit['status']) {
                        'Menunggu'         => 'waiting',
                        'Masih Berkunjung' => 'visiting',
                        'Selesai'          => 'completed',
                        'Ditolak'          => 'rejected',
                        'Dibatalkan'       => 'cancelled',
                        default            => 'default',
                    };
                    ?>

                    <tr>

                        <td class="visit-table-no">
                            <?= $no++ ?>
                        </td>


                        <td>

                            <strong class="visit-table-code">
                                <?= esc($visit['visit_code']) ?>
                            </strong>

                        </td>


                        <td>

                            <div class="visit-table-guest">

                                <div class="visit-table-guest-name">

                                    <?= esc($visit['guest_name']) ?>

                                </div>

                                <?php
                                $phone = (string) ($visit['phone'] ?? '-');

                                if (
                                    $phone !== '-'
                                    && strlen($phone) > 8
                                ) {
                                    $maskedPhone =
                                        substr($phone, 0, 4)
                                        . '****'
                                        . substr($phone, -4);
                                } else {
                                    $maskedPhone = $phone;
                                }
                                ?>

                                <div class="visit-table-guest-phone">

                                    <?= esc($maskedPhone) ?>

                                </div>

                            </div>

                        </td>


                        <td>

                            <div class="visit-table-purpose">

                                <div class="visit-table-purpose-dept">

                                    <?= esc($visit['department_name']) ?>

                                </div>

                                <div class="visit-table-purpose-emp">

                                    <?= esc($visit['employee_name']) ?>

                                </div>

                            </div>

                        </td>


                        <td>

                            <?php if (
                                $visit['status'] === 'Masih Berkunjung'
                                && ! empty($visit['check_in'])
                            ): ?>

                                <div class="visit-table-time">

                                    <div class="visit-table-time-date">

                                        <?= date(
                                            'd/m/Y',
                                            strtotime($visit['check_in'])
                                        ) ?>

                                    </div>

                                    <div class="visit-table-time-detail">

                                        Check-in:
                                        <?= date(
                                            'H:i',
                                            strtotime($visit['check_in'])
                                        ) ?>

                                    </div>

                                    <?php if ($durationText): ?>

                                        <div class="visit-table-time-duration">

                                            <i class="bi bi-clock"></i>

                                            <?= esc($durationText) ?>

                                        </div>

                                    <?php endif; ?>

                                </div>

                            <?php else: ?>

                                <div class="visit-table-time">

                                    <div class="visit-table-time-date">

                                        <?= date(
                                            'd/m/Y',
                                            strtotime($visit['arrival_time'])
                                        ) ?>

                                    </div>

                                    <div class="visit-table-time-detail">

                                        Pengajuan:
                                        <?= date(
                                            'H:i',
                                            strtotime($visit['arrival_time'])
                                        ) ?>

                                    </div>

                                </div>

                            <?php endif; ?>

                        </td>


                        <td>

                            <span class="visit-status-badge visit-status-badge--<?= $statusSlug ?>">

                                <?= esc($visit['status']) ?>

                            </span>

                        </td>


                        <?php if ($showDeletedMode): ?>

                            <td>
                                <span class="visit-table-deleted-at">
                                    <?= esc($visit['deleted_at'] ?? '-') ?>
                                </span>
                            </td>

                        <?php endif; ?>


                        <td>

                            <div class="employee-table-actions">

                                <a
                                    href="<?= site_url(
                                                $detailBaseUrl . '/detail/' . $visit['id']
                                            ) ?>"
                                    class="employee-action-button"
                                    title="Detail">

                                    <i class="bi bi-eye"></i>

                                    <span class="visually-hidden">
                                        Detail <?= esc($visit['visit_code']) ?>
                                    </span>

                                </a>


                                <?php if ($showDeletedMode): ?>

                                    <form
                                        action="<?= site_url('admin/bukutamu-kunjungan/restore/' . $visit['id']) ?>"
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
                                                Pulihkan <?= esc($visit['visit_code']) ?>
                                            </span>

                                        </button>

                                    </form>

                                <?php elseif (! $isHistoryMode && $visit['status'] === 'Menunggu'): ?>

                                    <button
                                        type="button"
                                        class="employee-action-button employee-action-button--warning"
                                        data-edit-visit-url="<?= site_url($detailBaseUrl . '/edit/' . $visit['id']) ?>"
                                        data-edit-visit-id="<?= esc($visit['id']) ?>"
                                        title="Edit">

                                        <i class="bi bi-pencil"></i>

                                        <span class="visually-hidden">
                                            Edit <?= esc($visit['visit_code']) ?>
                                        </span>

                                    </button>

                                <?php endif; ?>

                            </div>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="<?= $showDeletedMode ? 8 : 7 ?>">

                        <div class="employee-table-empty">

                            <i class="bi bi-calendar2-x"></i>

                            <p>Belum ada data kunjungan.</p>

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