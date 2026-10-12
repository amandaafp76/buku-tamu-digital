<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Buku Tamu</title>
    <style>
        * {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
        }

        body {
            margin: 20px;
            color: #111;
        }

        h1 {
            font-size: 16px;
            margin: 0 0 4px 0;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            font-size: 11px;
            margin-bottom: 12px;
            color: #444;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        .summary td {
            border: 1px solid #999;
            padding: 6px;
        }

        .summary .label {
            background: #f2f2f2;
            font-weight: bold;
            width: 18%;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data th,
        table.data td {
            border: 1px solid #999;
            padding: 5px 6px;
            vertical-align: top;
        }

        table.data th {
            background: #4F46E5;
            color: #fff;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 14px;
            font-size: 9px;
            text-align: right;
            color: #555;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            margin: 18px 0 6px 0;
            color: #4F46E5;
        }

        table.rekap {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 8px;
        }

        table.rekap th,
        table.rekap td {
            border: 1px solid #999;
            padding: 4px 6px;
            vertical-align: top;
        }

        table.rekap th {
            background: #e5e7eb;
            color: #111;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>LAPORAN BUKU TAMU DIGITAL</h1>

    <div class="subtitle">
        Periode:
        <?= esc($filters['start_date'] ?? '-') ?>
        s/d
        <?= esc($filters['end_date'] ?? '-') ?>

        <?php if (! empty($filters['status'])): ?>
            &middot; Status: <?= esc($filters['status']) ?>
        <?php endif; ?>

        <?php if (! empty($filters['institution'])): ?>
            &middot; Instansi: <?= esc($filters['institution']) ?>
        <?php endif; ?>
    </div>

    <table class="summary">
        <tr>
            <td class="label">Total Kunjungan</td>
            <td><?= esc($reportSummary['total_visits']) ?> kunjungan</td>

            <td class="label">Total Durasi</td>
            <td>
                <?= esc((int) floor($reportSummary['total_duration'] / 60)) ?> jam
                <?= esc($reportSummary['total_duration'] % 60) ?> menit
            </td>

            <td class="label">Rata-rata Durasi</td>
            <td>
                <?= esc((int) floor($reportSummary['average_duration'] / 60)) ?> jam
                <?= esc($reportSummary['average_duration'] % 60) ?> menit
            </td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 10%;">Kode</th>
                <th style="width: 14%;">Nama Tamu</th>
                <th style="width: 14%;">Asal Instansi</th>
                <th style="width: 12%;">Bagian</th>
                <th style="width: 14%;">Pegawai</th>
                <th style="width: 14%;">Keperluan</th>
                <th style="width: 12%;">Waktu</th>
                <th style="width: 9%;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($reportData)): ?>
                <tr>
                    <td colspan="9" class="text-center">
                        Tidak ada data kunjungan pada periode ini.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($reportData as $i => $visit): ?>
                    <tr>
                        <td class="text-center"><?= $i + 1 ?></td>
                        <td><?= esc($visit['visit_code'] ?? '-') ?></td>
                        <td><?= esc($visit['guest_name'] ?? '-') ?></td>
                        <td><?= esc($visit['institution'] ?: '-') ?></td>
                        <td><?= esc($visit['department_name'] ?: '-') ?></td>
                        <td><?= esc($visit['employee_name'] ?: '-') ?></td>
                        <td><?= esc($visit['purpose_name'] ?: '-') ?></td>
                        <td><?= esc($visit['arrival_time'] ?? '-') ?></td>
                        <td><?= esc($visit['status'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="section-title">Rekap per Bagian / Departemen</div>

    <table class="rekap">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Bagian / Departemen</th>
                <th style="width: 15%;">Jumlah</th>
                <th style="width: 20%;">Total Durasi</th>
                <th style="width: 20%;">Rata-rata</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($reportGrouping['by_department'])): ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($reportGrouping['by_department'] as $i => $row): ?>
                    <tr>
                        <td class="text-center"><?= $i + 1 ?></td>
                        <td><?= esc($row['department_name']) ?></td>
                        <td class="text-center"><?= esc($row['total_visits']) ?></td>
                        <td>
                            <?= esc((int) floor($row['total_duration'] / 60)) ?> jam
                            <?= esc($row['total_duration'] % 60) ?> menit
                        </td>
                        <td>
                            <?= esc((int) floor($row['average_duration'] / 60)) ?> jam
                            <?= esc($row['average_duration'] % 60) ?> menit
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="section-title">Rekap per Pegawai</div>

    <table class="rekap">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Pegawai</th>
                <th>Bagian / Departemen</th>
                <th style="width: 15%;">Jumlah</th>
                <th style="width: 20%;">Total Durasi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($reportGrouping['by_employee'])): ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($reportGrouping['by_employee'] as $i => $row): ?>
                    <tr>
                        <td class="text-center"><?= $i + 1 ?></td>
                        <td><?= esc($row['employee_name']) ?></td>
                        <td><?= esc($row['department_name']) ?></td>
                        <td class="text-center"><?= esc($row['total_visits']) ?></td>
                        <td>
                            <?= esc((int) floor($row['total_duration'] / 60)) ?> jam
                            <?= esc($row['total_duration'] % 60) ?> menit
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="section-title">Rekap per Asal Instansi</div>

    <table class="rekap">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Asal Instansi / Perusahaan</th>
                <th style="width: 20%;">Jumlah</th>
                <th style="width: 25%;">Total Durasi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($reportGrouping['by_institution'])): ?>
                <tr>
                    <td colspan="4" class="text-center">Tidak ada data.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($reportGrouping['by_institution'] as $i => $row): ?>
                    <tr>
                        <td class="text-center"><?= $i + 1 ?></td>
                        <td><?= esc($row['institution']) ?></td>
                        <td class="text-center"><?= esc($row['total_visits']) ?></td>
                        <td>
                            <?= esc((int) floor($row['total_duration'] / 60)) ?> jam
                            <?= esc($row['total_duration'] % 60) ?> menit
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: <?= esc($printedAt) ?>
    </div>

</body>

</html>