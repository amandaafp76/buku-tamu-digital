<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('pageCss') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/dashboard.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid px-0">

    <div class="mb-4">
        <h1 class="dashboard-heading">
            Dashboard
        </h1>

        <p class="dashboard-subheading">
            Ringkasan aktivitas buku tamu hari ini.
        </p>
    </div>

    <section class="mb-4">

        <div class="mb-3">
            <h2 class="dashboard-section-title">
                Statistik Kunjungan
            </h2>

            <p class="dashboard-panel-description">
                Ringkasan jumlah tamu dan kunjungan berdasarkan periode.
            </p>
        </div>

        <div class="row g-3">

            <!-- Hari Ini -->
            <div class="col-12 col-md-4">

                <div class="glass-card dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">
                        <i class="bi bi-calendar-day"></i>
                    </div>

                    <div class="dashboard-stat-content">

                        <span class="dashboard-stat-label">
                            Hari Ini
                        </span>

                        <strong class="dashboard-stat-value">
                            <?= esc($todayVisits) ?>
                        </strong>

                        <span class="dashboard-stat-label">
                            kunjungan
                        </span>

                        <div class="mt-2">
                            <span class="dashboard-stat-label">
                                <?= esc($todayGuests) ?> tamu
                            </span>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Minggu Ini -->
            <div class="col-12 col-md-4">

                <div class="glass-card dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">
                        <i class="bi bi-calendar-week"></i>
                    </div>

                    <div class="dashboard-stat-content">

                        <span class="dashboard-stat-label">
                            Minggu Ini
                        </span>

                        <strong class="dashboard-stat-value">
                            <?= esc($weekVisits) ?>
                        </strong>

                        <span class="dashboard-stat-label">
                            kunjungan
                        </span>

                        <div class="mt-2">
                            <span class="dashboard-stat-label">
                                <?= esc($weekGuests) ?> tamu
                            </span>
                        </div>

                    </div>

                </div>

            </div>

            <!-- Bulan Ini -->
            <div class="col-12 col-md-4">

                <div class="glass-card dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">
                        <i class="bi bi-calendar-month"></i>
                    </div>

                    <div class="dashboard-stat-content">

                        <span class="dashboard-stat-label">
                            Bulan Ini
                        </span>

                        <strong class="dashboard-stat-value">
                            <?= esc($monthVisits) ?>
                        </strong>

                        <span class="dashboard-stat-label">
                            kunjungan
                        </span>

                        <div class="mt-2">
                            <span class="dashboard-stat-label">
                                <?= esc($monthGuests) ?> tamu
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="mb-4">

        <div class="mb-3">

            <h2 class="dashboard-section-title">
                Data Master
            </h2>

        </div>

        <div class="row g-3">

            <div class="col-12 col-sm-6 col-xl-3">

                <div class="glass-card dashboard-master-card">

                    <span class="dashboard-master-label">
                        Pegawai
                    </span>

                    <strong class="dashboard-master-value">
                        <?= esc($totalEmployees) ?>
                    </strong>

                </div>

            </div>


            <div class="col-12 col-sm-6 col-xl-3">

                <div class="glass-card dashboard-master-card">

                    <span class="dashboard-master-label">
                        Departemen
                    </span>

                    <strong class="dashboard-master-value">
                        <?= esc($totalDepartments) ?>
                    </strong>

                </div>

            </div>


            <div class="col-12 col-sm-6 col-xl-3">

                <div class="glass-card dashboard-master-card">

                    <span class="dashboard-master-label">
                        Tujuan Kunjungan
                    </span>

                    <strong class="dashboard-master-value">
                        <?= esc($totalPurposes) ?>
                    </strong>

                </div>

            </div>


            <div class="col-12 col-sm-6 col-xl-3">

                <div class="glass-card dashboard-master-card">

                    <span class="dashboard-master-label">
                        Pengguna
                    </span>

                    <strong class="dashboard-master-value">
                        <?= esc($totalUsers) ?>
                    </strong>

                </div>

            </div>

        </div>

    </section>

    <section class="mb-4">

        <div class="mb-3">

            <h2 class="dashboard-section-title">
                Grafik Kunjungan
            </h2>

            <p class="dashboard-panel-description">
                Pergerakan jumlah kunjungan selama bulan berjalan.
            </p>

        </div>

        <div class="row g-3">

            <div class="col-12 col-xl-7">

                <div class="glass-card dashboard-panel h-100">

                    <div class="dashboard-panel-header">

                        <div>

                            <h2 class="dashboard-section-title mb-1">
                                Kunjungan Harian
                            </h2>

                            <p class="dashboard-panel-description">
                                Jumlah kunjungan berdasarkan tanggal.
                            </p>

                        </div>

                    </div>

                    <div class="dashboard-chart-wrapper">
                        <canvas id="dailyVisitsChart"></canvas>
                    </div>

                </div>

            </div>

            <div class="col-12">

                <div class="glass-card dashboard-panel h-100">

                    <div class="dashboard-panel-header">

                        <div>

                            <h2 class="dashboard-section-title mb-1">
                                Jam Kunjungan Terpadat
                            </h2>

                            <p class="dashboard-panel-description">
                                Jumlah kunjungan berdasarkan jam.
                            </p>

                        </div>

                    </div>

                    <div class="dashboard-chart-wrapper">
                        <canvas id="hourlyVisitsChart"></canvas>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="mb-4">

        <div class="mb-3">

            <h2 class="dashboard-section-title">
                Analisis Kunjungan
            </h2>

            <p class="dashboard-panel-description">
                Perbandingan jumlah kunjungan berdasarkan departemen dan pegawai.
            </p>

        </div>

        <div class="row g-3">

            <!-- Berdasarkan Departemen -->
            <div class="col-12 col-xl-6">

                <div class="glass-card dashboard-panel h-100">

                    <div class="dashboard-panel-header">

                        <div>

                            <h2 class="dashboard-section-title mb-1">
                                Berdasarkan Departemen
                            </h2>

                            <p class="dashboard-panel-description">
                                Lima departemen dengan jumlah kunjungan terbanyak.
                            </p>

                        </div>

                    </div>

                    <div class="dashboard-chart-wrapper dashboard-chart-wrapper--bar">
                        <canvas id="departmentVisitsChart"></canvas>
                    </div>

                </div>

            </div>

            <!-- Berdasarkan Pegawai -->
            <div class="col-12 col-xl-6">

                <div class="glass-card dashboard-panel h-100">

                    <div class="dashboard-panel-header">

                        <div>

                            <h2 class="dashboard-section-title mb-1">
                                Berdasarkan Pegawai
                            </h2>

                            <p class="dashboard-panel-description">
                                Lima pegawai dengan jumlah kunjungan terbanyak.
                            </p>

                        </div>

                    </div>

                    <div class="dashboard-chart-wrapper dashboard-chart-wrapper--bar">
                        <canvas id="employeeVisitsChart"></canvas>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="mb-4">

        <div class="mb-3">

            <h2 class="dashboard-section-title">
                Status Kunjungan
            </h2>

            <p class="dashboard-panel-description">
                Distribusi status seluruh kunjungan.
            </p>

        </div>

        <div class="row g-3">

            <div class="col-12">

                <div class="glass-card dashboard-panel h-100">

                    <div class="dashboard-panel-header">

                        <div>
                            <h2 class="dashboard-section-title mb-1">
                                Distribusi Status
                            </h2>

                            <p class="dashboard-panel-description">
                                Perbandingan berdasarkan status kunjungan.
                            </p>
                        </div>

                    </div>

                    <div class="dashboard-chart-wrapper dashboard-chart-wrapper--donut">
                        <canvas id="statusVisitsChart"></canvas>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="mb-4">

        <div class="mb-3">

            <h2 class="dashboard-section-title">
                Monitoring
            </h2>

            <p class="dashboard-panel-description">
                Pemantauan kunjungan terbaru dan kunjungan yang perlu diperhatikan.
            </p>

        </div>

        <div class="row g-3">

            <div class="col-12">

                <div class="glass-card dashboard-panel">

                    <div class="dashboard-panel-header">

                        <div>

                            <h2 class="dashboard-section-title mb-1">
                                Kunjungan Terbaru
                            </h2>

                            <p class="dashboard-panel-description">
                                Lima kunjungan terakhir yang tercatat dalam sistem.
                            </p>

                        </div>

                    </div>

                    <?php if (! empty($latestVisits)): ?>

                        <div class="dashboard-monitoring-table-wrapper">

                            <table class="dashboard-monitoring-table">

                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Tamu</th>
                                        <th>Departemen</th>
                                        <th>Pegawai</th>
                                        <th>Tujuan</th>
                                        <th>Jumlah</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php foreach ($latestVisits as $visit): ?>

                                        <tr>

                                            <td>
                                                <?= esc($visit['visit_code']) ?>
                                            </td>

                                            <td>
                                                <div class="dashboard-monitoring-guest">
                                                    <strong>
                                                        <?= esc($visit['guest_name']) ?>
                                                    </strong>
                                                </div>
                                            </td>

                                            <td>
                                                <?= esc($visit['department_name'] ?? '-') ?>
                                            </td>

                                            <td>
                                                <?= esc($visit['employee_name'] ?? '-') ?>
                                            </td>

                                            <td>
                                                <?= esc($visit['purpose_name'] ?? '-') ?>
                                            </td>

                                            <td>
                                                <?= esc($visit['group_size']) ?>
                                            </td>

                                            <td>
                                                <?= esc(date('d/m/Y H:i', strtotime($visit['arrival_time']))) ?>
                                            </td>

                                            <td>
                                                <span class="dashboard-monitoring-status">
                                                    <?= esc($visit['status']) ?>
                                                </span>
                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>

                    <?php else: ?>

                        <div class="dashboard-empty-state">

                            <div class="dashboard-empty-icon">
                                <i class="bi bi-clipboard-x"></i>
                            </div>

                            <h3 class="dashboard-empty-title">
                                Belum ada kunjungan
                            </h3>

                            <p class="dashboard-empty-description">
                                Data kunjungan terbaru akan muncul di sini setelah ada kunjungan yang tercatat.
                            </p>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <div class="row g-3 mt-0">
            <div class="col-12">
                <div class="glass-card dashboard-panel">
                    <div class="dashboard-panel-header">
                        <div>
                            <h2 class="dashboard-section-title mb-1">
                                Kunjungan Terlalu Lama
                            </h2>
                            <p class="dashboard-panel-description">
                                Kunjungan yang sudah melewati batas waktu
                                <?= esc($warningLimit) ?> menit.
                            </p>
                        </div>

                        <?php if (! empty($tooLongVisits)): ?>
                            <span class="dashboard-monitoring-status dashboard-monitoring-status--warning">
                                <?= count($tooLongVisits) ?> perlu diperhatikan
                            </span>
                        <?php endif; ?>
                    </div>

                    <?php if (! empty($tooLongVisits)): ?>
                        <div class="dashboard-monitoring-table-wrapper">
                            <table class="dashboard-monitoring-table">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Tamu</th>
                                        <th>Departemen</th>
                                        <th>Pegawai</th>
                                        <th>Check-in</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($tooLongVisits as $visit): ?>
                                        <?php
                                        $checkInTime = strtotime($visit['check_in']);
                                        $durationMinutes = max(
                                            0,
                                            (int) floor((time() - $checkInTime) / 60)
                                        );

                                        $durationHours = intdiv($durationMinutes, 60);
                                        $remainingMinutes = $durationMinutes % 60;
                                        ?>

                                        <tr>
                                            <td>
                                                <?= esc($visit['visit_code']) ?>
                                            </td>

                                            <td>
                                                <div class="dashboard-monitoring-guest">
                                                    <strong>
                                                        <?= esc($visit['guest_name']) ?>
                                                    </strong>
                                                </div>
                                            </td>

                                            <td>
                                                <?= esc($visit['department_name'] ?? '-') ?>
                                            </td>

                                            <td>
                                                <?= esc($visit['employee_name'] ?? '-') ?>
                                            </td>

                                            <td>
                                                <?= esc(date(
                                                    'd/m/Y H:i',
                                                    $checkInTime
                                                )) ?>
                                            </td>

                                            <td>
                                                <span class="dashboard-monitoring-status dashboard-monitoring-status--warning">
                                                    <?= $durationHours > 0
                                                        ? esc($durationHours . ' jam ' . $remainingMinutes . ' menit')
                                                        : esc($durationMinutes . ' menit')
                                                    ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="dashboard-empty-state">
                            <div class="dashboard-empty-icon">
                                <i class="bi bi-check2-circle"></i>
                            </div>

                            <h3 class="dashboard-empty-title">
                                Tidak ada kunjungan terlalu lama
                            </h3>

                            <p class="dashboard-empty-description">
                                Saat ini tidak ada kunjungan yang melewati
                                batas waktu yang telah ditentukan.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </section>

</div>

<div
    id="dashboard-data"
    data-daily-visits='<?= esc(json_encode($dailyVisits), 'attr') ?>'
    data-hourly-visits='<?= esc(json_encode($hourlyVisits), 'attr') ?>'
    data-status-chart='<?= esc(json_encode($statusChart), 'attr') ?>'
    data-department-visits='<?= esc(json_encode($departmentVisits), 'attr') ?>'
    data-employee-visits='<?= esc(json_encode($employeeVisits), 'attr') ?>'>
</div>

<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/dashboard.js') ?>"></script>

<?= $this->endSection() ?>