<?php

$detailBaseUrl = url_is('admin/bukutamu-kunjungan*')
    ? 'admin/bukutamu-kunjungan'
    : 'petugas/bukutamu-kunjungan';

?>

<div class="table-responsive">

    <table class="table align-middle">

        <thead>

            <tr>

                <th>No</th>
                <th>Kode Kunjungan</th>
                <th>Tamu</th>
                <th>Tujuan</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>

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
                    ?>

                    <tr>

                        <td>
                            <?= $no++ ?>
                        </td>

                        <td>

                            <strong>
                                <?= esc($visit['visit_code']) ?>
                            </strong>

                        </td>

                        <td>

                            <strong>
                                <?= esc($visit['guest_name']) ?>
                            </strong>

                            <br>

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

                            <small class="text-muted">
                                <?= esc($maskedPhone) ?>
                            </small>

                        </td>

                        <td>

                            <?= esc($visit['department_name']) ?>

                            <br>

                            <small class="text-muted">
                                <?= esc($visit['employee_name']) ?>
                            </small>

                        </td>

                        <td>

                            <?php if (
                                $visit['status'] === 'Masih Berkunjung'
                                && ! empty($visit['check_in'])
                            ): ?>

                                <?= date(
                                    'd/m/Y',
                                    strtotime($visit['check_in'])
                                ) ?>

                                <br>

                                <small class="text-muted">

                                    Check-in:
                                    <?= date(
                                        'H:i',
                                        strtotime($visit['check_in'])
                                    ) ?>

                                </small>

                                <?php if ($durationText): ?>

                                    <br>

                                    <small class="text-primary">

                                        <i class="bi bi-clock"></i>

                                        <?= esc($durationText) ?>

                                    </small>

                                <?php endif; ?>

                            <?php else: ?>

                                <?= date(
                                    'd/m/Y',
                                    strtotime($visit['arrival_time'])
                                ) ?>

                                <br>

                                <small class="text-muted">

                                    Pengajuan:
                                    <?= date(
                                        'H:i',
                                        strtotime($visit['arrival_time'])
                                    ) ?>

                                </small>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?php if ($visit['status'] === 'Menunggu'): ?>

                                <span class="badge bg-warning text-dark">
                                    Menunggu
                                </span>

                            <?php elseif ($visit['status'] === 'Masih Berkunjung'): ?>

                                <span class="badge bg-primary">
                                    Masih Berkunjung
                                </span>

                            <?php elseif ($visit['status'] === 'Selesai'): ?>

                                <span class="badge bg-success">
                                    Selesai
                                </span>

                            <?php elseif ($visit['status'] === 'Ditolak'): ?>

                                <span class="badge bg-danger">
                                    Ditolak
                                </span>

                            <?php elseif ($visit['status'] === 'Dibatalkan'): ?>

                                <span class="badge bg-secondary">
                                    Dibatalkan
                                </span>

                            <?php else: ?>

                                <span class="badge bg-secondary">
                                    <?= esc($visit['status']) ?>
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <a
                                href="<?= site_url(
                                            $detailBaseUrl . '/detail/' . $visit['id']
                                        ) ?>"
                                class="btn btn-sm btn-outline-primary">

                                <i class="bi bi-eye"></i>
                                Detail

                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td
                        colspan="7"
                        class="text-center text-muted py-4">

                        Belum ada data kunjungan.

                    </td>

                </tr>

            <?php endif; ?>

        </tbody>

    </table>

</div>