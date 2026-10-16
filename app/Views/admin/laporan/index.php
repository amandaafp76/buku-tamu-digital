<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('pageCss') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/dashboard.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="visit-page">

    <div class="dashboard-header mb-4">

        <div class="dashboard-header-text">

            <div>

                <h1 class="dashboard-heading">
                    Laporan
                </h1>

                <p class="dashboard-subheading">
                    Melihat dan mengunduh laporan data kunjungan tamu.
                </p>

            </div>

        </div>

    </div>

    <div class="glass-card dashboard-panel dashboard-visit-filter mb-4">

        <div class="dashboard-header-text mb-3">

            <h5 class="dashboard-heading">
                Filter Laporan
            </h5>

            <p class="dashboard-subheading">
                Tentukan periode dan data yang ingin ditampilkan dalam laporan.
            </p>

        </div>


        <form
            action="<?= site_url('admin/bukutamu-laporan') ?>"
            method="get"
            id="laporanFilterForm">

            <div class="row g-3">

                <div class="col-12 col-md-6">

                    <label
                        for="reportPeriod"
                        class="employee-filter-label">

                        Periode

                    </label>

                    <select
                        name="period"
                        id="reportPeriod"
                        class="form-select employee-filter-input">

                        <option
                            value="daily"
                            <?= $filters['period'] === 'daily' ? 'selected' : '' ?>>

                            Harian

                        </option>

                        <option
                            value="weekly"
                            <?= $filters['period'] === 'weekly' ? 'selected' : '' ?>>

                            Mingguan

                        </option>

                        <option
                            value="monthly"
                            <?= $filters['period'] === 'monthly' ? 'selected' : '' ?>>

                            Bulanan

                        </option>

                        <option
                            value="range"
                            <?= $filters['period'] === 'range' ? 'selected' : '' ?>>

                            Rentang Tanggal

                        </option>

                    </select>

                </div>


                <div class="col-12 col-md-6">

                    <label
                        for="reportDepartment"
                        class="employee-filter-label">

                        Bagian / Departemen

                    </label>

                    <select
                        name="department_id"
                        id="reportDepartment"
                        class="form-select employee-filter-input">

                        <option value="">
                            Semua Bagian / Departemen
                        </option>

                        <?php foreach ($departments as $department): ?>

                            <option
                                value="<?= esc($department['id']) ?>"
                                <?= (string) $filters['department_id'] === (string) $department['id']
                                    ? 'selected'
                                    : '' ?>>

                                <?= esc($department['name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <div
                    id="reportPeriodFields"
                    class="row g-3 mt-1">

                    <div
                        id="monthlyFields"
                        class="col-12 col-md-6">

                        <label
                            for="reportMonth"
                            class="employee-filter-label">

                            Bulan

                        </label>

                        <input
                            type="month"
                            name="month"
                            id="reportMonth"
                            class="form-control employee-filter-input"
                            value="<?= esc(
                                        $filters['month'] !== ''
                                            ? $filters['month']
                                            : date('Y-m')
                                    ) ?>">

                    </div>

                    <div class="col-12 col-md-6">

                        <label
                            for="reportEmployee"
                            class="employee-filter-label">

                            Pegawai

                        </label>

                        <select
                            name="employee_id"
                            id="reportEmployee"
                            class="form-select employee-filter-input">

                            <option value="">
                                Semua Pegawai
                            </option>

                            <?php foreach ($employees as $employee): ?>

                                <option
                                    value="<?= esc($employee['id']) ?>"
                                    <?= (string) $filters['employee_id'] === (string) $employee['id']
                                        ? 'selected'
                                        : '' ?>>

                                    <?= esc($employee['employee_name']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                </div>

                <div
                    id="dailyFields"
                    class="col-12 col-md-6 col-lg-4 d-none">

                    <label
                        for="reportDate"
                        class="employee-filter-label">

                        Tanggal

                    </label>

                    <input
                        type="date"
                        name="date"
                        id="reportDate"
                        class="form-control employee-filter-input"
                        value="<?= esc(
                                    $filters['date'] !== ''
                                        ? $filters['date']
                                        : date('Y-m-d')
                                ) ?>">

                </div>

                <div
                    id="weeklyFields"
                    class="col-12 col-md-6 col-lg-4 d-none">

                    <label
                        for="reportWeek"
                        class="employee-filter-label">

                        Tanggal Awal Minggu

                    </label>

                    <input
                        type="date"
                        name="week_start"
                        id="reportWeek"
                        class="form-control employee-filter-input"
                        value="<?= esc(
                                    $filters['week_start'] !== ''
                                        ? $filters['week_start']
                                        : date(
                                            'Y-m-d',
                                            strtotime('monday this week')
                                        )
                                ) ?>">

                </div>

                <div
                    id="rangeFields"
                    class="col-12 row g-3 d-none">

                    <div class="col-12 col-md-6">

                        <label
                            for="reportStartDate"
                            class="employee-filter-label">

                            Tanggal Mulai

                        </label>

                        <input
                            type="date"
                            name="start_date"
                            id="reportStartDate"
                            class="form-control employee-filter-input"
                            value="<?= esc($filters['start_date']) ?>">

                    </div>


                    <div class="col-12 col-md-6">

                        <label
                            for="reportEndDate"
                            class="employee-filter-label">

                            Tanggal Selesai

                        </label>

                        <input
                            type="date"
                            name="end_date"
                            id="reportEndDate"
                            class="form-control employee-filter-input"
                            value="<?= esc($filters['end_date']) ?>">

                    </div>

                </div>

            </div>


            <div class="row g-3 mt-1">

                <div class="col-12 col-md-6">

                    <label
                        for="reportInstitution"
                        class="employee-filter-label">

                        Asal Instansi / Perusahaan

                    </label>

                    <input
                        type="text"
                        name="institution"
                        id="reportInstitution"
                        class="form-control employee-filter-input"
                        value="<?= esc($filters['institution']) ?>"
                        placeholder="Contoh: PT Maju Jaya">

                </div>

                <div class="col-12 col-md-6">

                    <label
                        for="reportStatus"
                        class="employee-filter-label">

                        Status

                    </label>

                    <select
                        name="status"
                        id="reportStatus"
                        class="form-select employee-filter-input">

                        <option value="">
                            Semua Status
                        </option>

                        <option value="Menunggu" <?= $filters['status'] === 'Menunggu' ? 'selected' : '' ?>>Menunggu</option>
                        <option value="Masih Berkunjung" <?= $filters['status'] === 'Masih Berkunjung' ? 'selected' : '' ?>>Masih Berkunjung</option>
                        <option value="Selesai" <?= $filters['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                        <option value="Ditolak" <?= $filters['status'] === 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                        <option value="Dibatalkan" <?= $filters['status'] === 'Dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>

                    </select>

                </div>

            </div>


            <div class="report-filter-actions">

                <button
                    type="submit"
                    class="dashboard-primary-button">

                    <i class="bi bi-funnel-fill"></i>
                    Terapkan Filter

                </button>

            </div>

        </form>

    </div>


    <?php if (! empty($reportData)): ?>

        <?php
        $queryString = http_build_query(array_filter([
            'period'        => $filters['period'],
            'month'         => $filters['month'],
            'date'          => $filters['date'],
            'week_start'    => $filters['week_start'],
            'start_date'    => $filters['start_date'],
            'end_date'      => $filters['end_date'],
            'department_id' => $filters['department_id'],
            'employee_id'   => $filters['employee_id'],
            'institution'   => $filters['institution'],
            'status'        => $filters['status'],
        ], fn($v) => $v !== '' && $v !== null));
        ?>

        <div class="report-stats-grid mb-4">

            <div class="glass-card report-stat-card">

                <div class="report-stat-icon">

                    <i class="bi bi-journal-check"></i>

                </div>

                <div class="report-stat-body">

                    <div class="report-stat-label">
                        Total Kunjungan
                    </div>

                    <div class="report-stat-value">
                        <?= esc($reportSummary['total_visits']) ?>
                        <span class="report-stat-unit">kunjungan</span>
                    </div>

                </div>

            </div>


            <div class="glass-card report-stat-card">

                <div class="report-stat-icon">

                    <i class="bi bi-clock-history"></i>

                </div>

                <div class="report-stat-body">

                    <div class="report-stat-label">
                        Total Durasi
                    </div>

                    <div class="report-stat-value">

                        <?php
                        $totalMinutes = (int) floor($reportSummary['total_duration'] / 60);
                        $totalHours = (int) floor($totalMinutes / 60);
                        $remainingMinutes = $totalMinutes % 60;
                        ?>

                        <?= esc($totalHours) ?>
                        <span class="report-stat-unit">jam</span>
                        <?= esc($remainingMinutes) ?>
                        <span class="report-stat-unit">menit</span>

                    </div>

                </div>

            </div>


            <div class="glass-card report-stat-card">

                <div class="report-stat-icon">

                    <i class="bi bi-stopwatch"></i>

                </div>

                <div class="report-stat-body">

                    <div class="report-stat-label">
                        Rata-rata Durasi
                    </div>

                    <div class="report-stat-value">

                        <?php
                        $averageMinutes = (int) floor($reportSummary['average_duration'] / 60);
                        $averageHours = (int) floor($averageMinutes / 60);
                        $averageRemainingMinutes = $averageMinutes % 60;
                        ?>

                        <?= esc($averageHours) ?>
                        <span class="report-stat-unit">jam</span>
                        <?= esc($averageRemainingMinutes) ?>
                        <span class="report-stat-unit">menit</span>

                    </div>

                </div>

            </div>

        </div>

        <div class="report-block mb-4">

            <div class="report-block-header">

                <div>

                    <h5 class="report-block-title">
                        Data Kunjungan
                    </h5>

                    <p class="report-block-description">
                        Detail data kunjungan sesuai filter yang dipilih.
                    </p>

                </div>

                <div class="report-export-actions">

                    <a
                        href="<?= site_url('admin/bukutamu-laporan/pdf') . '?' . $queryString ?>"
                        target="_blank"
                        class="report-export-button report-export-button--pdf">

                        <i class="bi bi-file-earmark-pdf"></i>
                        Cetak PDF

                    </a>

                    <a
                        href="<?= site_url('admin/bukutamu-laporan/excel') . '?' . $queryString ?>"
                        class="report-export-button report-export-button--excel">

                        <i class="bi bi-file-earmark-excel"></i>
                        Export Excel

                    </a>

                </div>

            </div>


            <div class="glass-card report-block-body">

                <div class="table-responsive">

                    <table class="report-table align-middle mb-0">

                        <thead>

                            <tr>

                                <th class="report-table-no">No</th>
                                <th>Kode Kunjungan</th>
                                <th>Tamu</th>
                                <th>Asal Instansi</th>
                                <th>Bagian</th>
                                <th>Pegawai</th>
                                <th>Tujuan</th>
                                <th>Waktu</th>
                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($reportData as $index => $visit): ?>

                                <?php
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

                                    <td class="report-table-no">
                                        <?= $index + 1 ?>
                                    </td>

                                    <td>

                                        <strong class="visit-table-code">
                                            <?= esc($visit['visit_code']) ?>
                                        </strong>

                                    </td>

                                    <td>

                                        <span class="report-table-guest">
                                            <?= esc($visit['guest_name']) ?>
                                        </span>

                                    </td>

                                    <td>
                                        <?= esc($visit['institution'] ?: '-') ?>
                                    </td>

                                    <td>
                                        <?= esc($visit['department_name'] ?: '-') ?>
                                    </td>

                                    <td>
                                        <?= esc($visit['employee_name'] ?: '-') ?>
                                    </td>

                                    <td>
                                        <?= esc($visit['purpose_name'] ?: '-') ?>
                                    </td>

                                    <td>

                                        <span class="report-table-time">
                                            <?= esc($visit['arrival_time']) ?>
                                        </span>

                                    </td>

                                    <td>

                                        <span class="visit-status-badge visit-status-badge--<?= $statusSlug ?>">

                                            <?= esc($visit['status']) ?>

                                        </span>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="report-block mb-4">

            <div class="report-block-header">

                <div>

                    <h5 class="report-block-title">
                        Rekap per Bagian / Departemen
                    </h5>

                    <p class="report-block-description">
                        Ringkasan jumlah dan durasi kunjungan tiap bagian/departemen.
                    </p>

                </div>

            </div>


            <div class="glass-card report-block-body">

                <div class="table-responsive">

                    <table class="report-table align-middle mb-0">

                        <thead>
                            <tr>
                                <th class="report-table-no">No</th>
                                <th>Bagian / Departemen</th>
                                <th class="report-table-center">Jumlah Kunjungan</th>
                                <th class="report-table-center">Total Durasi</th>
                                <th class="report-table-center">Rata-rata Durasi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (empty($reportGrouping['by_department'])): ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="employee-table-empty">
                                            <i class="bi bi-diagram-3"></i>
                                            <p>Tidak ada data.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($reportGrouping['by_department'] as $i => $row): ?>
                                    <tr>
                                        <td class="report-table-no"><?= $i + 1 ?></td>
                                        <td>
                                            <strong class="report-table-name">
                                                <?= esc($row['department_name']) ?>
                                            </strong>
                                        </td>
                                        <td class="report-table-center">
                                            <span class="visit-purpose-count-badge">
                                                <i class="bi bi-journal-check"></i>
                                                <?= esc($row['total_visits']) ?>
                                            </span>
                                        </td>
                                        <td class="report-table-center">
                                            <?= esc((int) floor($row['total_duration'] / 60)) ?>
                                            jam
                                            <?= esc($row['total_duration'] % 60) ?>
                                            menit
                                        </td>
                                        <td class="report-table-center">
                                            <?= esc((int) floor($row['average_duration'] / 60)) ?>
                                            jam
                                            <?= esc($row['average_duration'] % 60) ?>
                                            menit
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="report-block mb-4">

            <div class="report-block-header">

                <div>

                    <h5 class="report-block-title">
                        Rekap per Pegawai
                    </h5>

                    <p class="report-block-description">
                        Ringkasan jumlah dan durasi kunjungan tiap pegawai.
                    </p>

                </div>

            </div>


            <div class="glass-card report-block-body">

                <div class="table-responsive">

                    <table class="report-table align-middle mb-0">

                        <thead>
                            <tr>
                                <th class="report-table-no">No</th>
                                <th>Pegawai</th>
                                <th>Bagian / Departemen</th>
                                <th class="report-table-center">Jumlah Kunjungan</th>
                                <th class="report-table-center">Total Durasi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (empty($reportGrouping['by_employee'])): ?>
                                <tr>
                                    <td colspan="5">
                                        <div class="employee-table-empty">
                                            <i class="bi bi-people"></i>
                                            <p>Tidak ada data.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($reportGrouping['by_employee'] as $i => $row): ?>
                                    <tr>
                                        <td class="report-table-no"><?= $i + 1 ?></td>
                                        <td>
                                            <strong class="report-table-name">
                                                <?= esc($row['employee_name']) ?>
                                            </strong>
                                        </td>
                                        <td><?= esc($row['department_name']) ?></td>
                                        <td class="report-table-center">
                                            <span class="visit-purpose-count-badge">
                                                <i class="bi bi-journal-check"></i>
                                                <?= esc($row['total_visits']) ?>
                                            </span>
                                        </td>
                                        <td class="report-table-center">
                                            <?= esc((int) floor($row['total_duration'] / 60)) ?>
                                            jam
                                            <?= esc($row['total_duration'] % 60) ?>
                                            menit
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="report-block mb-4">

            <div class="report-block-header">

                <div>

                    <h5 class="report-block-title">
                        Rekap per Asal Instansi
                    </h5>

                    <p class="report-block-description">
                        Ringkasan jumlah dan durasi kunjungan tiap instansi.
                    </p>

                </div>

            </div>


            <div class="glass-card report-block-body">

                <div class="table-responsive">

                    <table class="report-table align-middle mb-0">

                        <thead>
                            <tr>
                                <th class="report-table-no">No</th>
                                <th>Asal Instansi / Perusahaan</th>
                                <th class="report-table-center">Jumlah Kunjungan</th>
                                <th class="report-table-center">Total Durasi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if (empty($reportGrouping['by_institution'])): ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="employee-table-empty">
                                            <i class="bi bi-building"></i>
                                            <p>Tidak ada data.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($reportGrouping['by_institution'] as $i => $row): ?>
                                    <tr>
                                        <td class="report-table-no"><?= $i + 1 ?></td>
                                        <td>
                                            <strong class="report-table-name">
                                                <?= esc($row['institution']) ?>
                                            </strong>
                                        </td>
                                        <td class="report-table-center">
                                            <span class="visit-purpose-count-badge">
                                                <i class="bi bi-journal-check"></i>
                                                <?= esc($row['total_visits']) ?>
                                            </span>
                                        </td>
                                        <td class="report-table-center">
                                            <?= esc((int) floor($row['total_duration'] / 60)) ?>
                                            jam
                                            <?= esc($row['total_duration'] % 60) ?>
                                            menit
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    <?php else: ?>

        <div class="glass-card employee-table-card">

            <div class="employee-table-empty">

                <i class="bi bi-file-earmark-bar-graph"></i>

                <p>
                    Tidak ada data kunjungan berdasarkan filter yang dipilih.
                </p>

            </div>

        </div>

    <?php endif; ?>

    <?= $this->endSection() ?>

    <?= $this->section('pageJs') ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const periodSelect =
                document.getElementById('reportPeriod');

            const monthlyFields =
                document.getElementById('monthlyFields');

            const dailyFields =
                document.getElementById('dailyFields');

            const weeklyFields =
                document.getElementById('weeklyFields');

            const rangeFields =
                document.getElementById('rangeFields');


            function updatePeriodFields() {

                const period = periodSelect.value;


                monthlyFields.classList.add('d-none');
                dailyFields.classList.add('d-none');
                weeklyFields.classList.add('d-none');
                rangeFields.classList.add('d-none');


                if (period === 'monthly') {

                    monthlyFields.classList.remove('d-none');

                }

                if (period === 'daily') {

                    dailyFields.classList.remove('d-none');

                }

                if (period === 'weekly') {

                    weeklyFields.classList.remove('d-none');

                }

                if (period === 'range') {

                    rangeFields.classList.remove('d-none');

                }

            }


            periodSelect.addEventListener(
                'change',
                updatePeriodFields
            );


            updatePeriodFields();

        });
    </script>

    <?= $this->endSection() ?>