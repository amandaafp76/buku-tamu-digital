<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Buku Tamu</title>
    <style>
        * {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            box-sizing: border-box;
        }

        body {
            margin: 20px 24px;
            color: #1a1a1a;
            background: #FFFFFF;
        }

        .kop-surat {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        .kop-surat td {
            vertical-align: middle;
            border: 0;
            padding: 0;
        }

        .kop-surat .logo-cell {
            width: 70px;
            text-align: left;
            padding-right: 14px;
        }

        .kop-surat .logo-cell img {
            width: 58px;
            height: auto;
            border-radius: 12px;
        }

        .kop-surat .info-cell {
            text-align: left;
        }

        .kop-surat .institution-name {
            font-size: 14px;
            font-weight: bold;
            color: #111;
            margin: 0;
            line-height: 1.2;
            letter-spacing: -0.01em;
        }

        .kop-surat .institution-address {
            font-size: 9px;
            color: #666;
            margin: 3px 0 0;
            line-height: 1.4;
        }

        .kop-divider {
            border: 0;
            border-top: 2px solid <?= esc($primaryColor) ?>;
            border-bottom: 1px solid #e5e5e5;
            height: 4px;
            margin: 0 0 14px;
        }

        h1.report-title {
            font-size: 15px;
            margin: 0 0 4px 0;
            text-align: center;
            letter-spacing: 0.04em;
            color: #111;
            font-weight: bold;
        }

        .subtitle {
            text-align: center;
            font-size: 10px;
            margin-bottom: 16px;
            color: #555;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 8px 0;
            margin-bottom: 16px;
        }

        .summary td {
            padding: 10px 14px;
            background: #fafafa;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            vertical-align: middle;
        }

        .summary .label {
            background: transparent;
            border: 0;
            padding: 0;
            font-size: 9px;
            color: #888;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .summary .value {
            background: transparent;
            border: 0;
            padding: 0;
            font-size: 13px;
            color: #111;
            font-weight: bold;
            text-align: left;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e5e5;
        }

        table.data th,
        table.data td {
            padding: 7px 8px;
            vertical-align: top;
            border-bottom: 1px solid #f0f0f0;
        }

        table.data th {
            background: <?= esc($primaryColor) ?>;
            color: #fff;
            text-align: center;
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 0.02em;
            border-bottom: 0;
        }

        table.data th:first-child {
            border-top-left-radius: 12px;
        }

        table.data th:last-child {
            border-top-right-radius: 12px;
        }

        table.data td {
            font-size: 9px;
            color: #333;
            background: #FFFFFF;
        }

        table.data tr:last-child td {
            border-bottom: 0;
        }

        table.data tr:nth-child(even) td {
            background: #fafafa;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            padding-top: 8px;
            border-top: 1px solid #e5e5e5;
            font-size: 8px;
            text-align: right;
            color: #888;
            letter-spacing: 0.02em;
        }

        .section-title {
            font-size: 11px;
            font-weight: bold;
            margin: 20px 0 8px 0;
            color: #111;
            letter-spacing: 0.02em;
            padding-left: 10px;
            border-left: 3px solid <?= esc($primaryColor) ?>;
        }

        table.rekap {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 10px;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            overflow: hidden;
        }

        table.rekap th,
        table.rekap td {
            padding: 6px 8px;
            vertical-align: top;
            border-bottom: 1px solid #f0f0f0;
        }

        table.rekap th {
            background: #f5f5f5;
            color: #111;
            text-align: center;
            font-weight: bold;
            font-size: 9px;
            letter-spacing: 0.02em;
            border-bottom: 1px solid #e5e5e5;
        }

        table.rekap td {
            font-size: 9px;
            color: #333;
            background: #FFFFFF;
        }

        table.rekap tr:last-child td {
            border-bottom: 0;
        }

        table.rekap tr:nth-child(even) td {
            background: #fafafa;
        }
    </style>
</head>

<body>
    <?php if (! empty($institution)): ?>

        <table class="kop-surat">
            <tr>

                <?php if (! empty($logoBase64)): ?>
                    <td class="logo-cell">
                        <img src="<?= $logoBase64 ?>" alt="Logo">
                    </td>
                <?php endif; ?>

                <td class="info-cell">
                    <div class="institution-name">
                        <?= esc($institution['name'] ?? 'Institusi') ?>
                    </div>

                    <?php if (! empty($institution['address'])): ?>
                        <div class="institution-address">
                            <?= esc($institution['address']) ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    $contact = [];

                    if (! empty($institution['phone'])) {
                        $contact[] = 'Telp: ' . $institution['phone'];
                    }

                    if (! empty($institution['email'])) {
                        $contact[] = 'Email: ' . $institution['email'];
                    }

                    if (! empty($contact)): ?>

                        <div class="institution-address">
                            <?= esc(implode(' · ', $contact)) ?>
                        </div>

                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <hr class="kop-divider">

    <?php endif; ?>

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
            <td style="width: 33%;">
                <div class="label">Total Kunjungan</div>
                <div class="value">
                    <?= esc($reportSummary['total_visits']) ?> kunjungan
                </div>
            </td>

            <td style="width: 33%;">
                <div class="label">Total Durasi</div>
                <div class="value">
                    <?= esc((int) floor($reportSummary['total_duration'] / 60)) ?> jam
                    <?= esc($reportSummary['total_duration'] % 60) ?> menit
                </div>
            </td>

            <td style="width: 33%;">
                <div class="label">Rata-rata Durasi</div>
                <div class="value">
                    <?= esc((int) floor($reportSummary['average_duration'] / 60)) ?> jam
                    <?= esc($reportSummary['average_duration'] % 60) ?> menit
                </div>
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
        &nbsp;·&nbsp;
        Halaman {PAGE_NUM} dari {PAGE_COUNT}
    </div>

</body>

</html>