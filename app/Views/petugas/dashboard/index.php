<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('pageCss') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/dashboard.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <div class="dashboard-header mb-4">

        <div>
            <h1 class="dashboard-heading">
                Dashboard Petugas
            </h1>

            <p class="dashboard-subheading">
                Pantau aktivitas kunjungan tamu secara langsung.
            </p>
        </div>

        <button
            type="button"
            class="btn dashboard-filter-button"
            data-bs-toggle="modal"
            data-bs-target="#dashboardFilterModal">

            <i class="bi bi-funnel-fill"></i>
            Filter Dashboard

        </button>

    </div>

    <?php if (! empty($filterError)): ?>

        <div class="alert alert-warning mb-4" role="alert">

            <i class="bi bi-exclamation-triangle me-2"></i>

            <?= esc($filterError) ?>

        </div>

    <?php endif; ?>

    <div class="mb-4">

        <div class="mb-3">

            <h2 class="dashboard-section-title">
                Statistik Kunjungan
            </h2>

            <p class="dashboard-panel-description">

                <?php if ($isFiltered): ?>

                    Ringkasan kunjungan pada periode
                    <?= date('d-m-Y', strtotime($filterStartDate)) ?>
                    sampai
                    <?= date('d-m-Y', strtotime($filterEndDate)) ?>.

                <?php else: ?>

                    Ringkasan jumlah tamu dan kunjungan berdasarkan periode.

                <?php endif; ?>

            </p>

        </div>


        <div class="row g-3">

            <div class="col-md-4">

                <div class="glass-card dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">

                        <i class="bi bi-calendar-day"></i>

                    </div>

                    <div class="dashboard-stat-content">

                        <span class="dashboard-stat-label">

                            <?php if ($isFiltered): ?>

                                Tamu pada Periode

                            <?php else: ?>

                                Tamu Hari Ini

                            <?php endif; ?>

                        </span>

                        <strong class="dashboard-stat-value">

                            <?php if ($isFiltered): ?>

                                <?= esc($periodGuests) ?>

                            <?php else: ?>

                                <?= esc($todayGuests) ?>

                            <?php endif; ?>

                        </strong>

                        <span class="dashboard-stat-label">
                            orang
                        </span>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="glass-card dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">

                        <i class="bi bi-calendar-week"></i>

                    </div>

                    <div class="dashboard-stat-content">

                        <span class="dashboard-stat-label">
                            Tamu Minggu Ini
                        </span>

                        <strong class="dashboard-stat-value">
                            <?= esc($weekGuests) ?>
                        </strong>

                        <span class="dashboard-stat-label">
                            orang
                        </span>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="glass-card dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">

                        <i class="bi bi-calendar-month"></i>

                    </div>

                    <div class="dashboard-stat-content">

                        <span class="dashboard-stat-label">
                            Tamu Bulan Ini
                        </span>

                        <strong class="dashboard-stat-value">
                            <?= esc($monthGuests) ?>
                        </strong>

                        <span class="dashboard-stat-label">
                            orang
                        </span>

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="glass-card dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">

                        <i class="bi bi-people"></i>

                    </div>

                    <div class="dashboard-stat-content">

                        <span class="dashboard-stat-label">
                            Total Tamu
                        </span>

                        <strong class="dashboard-stat-value">

                            <?php if ($isFiltered): ?>

                                <?= esc($periodGuests) ?>

                            <?php else: ?>

                                <?= esc($totalGuests) ?>

                            <?php endif; ?>

                        </strong>

                        <span class="dashboard-stat-label">

                            <?php if ($isFiltered): ?>

                                orang pada periode

                            <?php else: ?>

                                orang

                            <?php endif; ?>

                        </span>

                    </div>

                </div>

            </div>


            <div class="col-md-6">

                <div class="glass-card dashboard-stat-card h-100">

                    <div class="dashboard-stat-icon">

                        <i class="bi bi-journal-check"></i>

                    </div>

                    <div class="dashboard-stat-content">

                        <span class="dashboard-stat-label">
                            Total Kunjungan
                        </span>

                        <strong class="dashboard-stat-value">

                            <?php if ($isFiltered): ?>

                                <?= esc($periodVisits) ?>

                            <?php else: ?>

                                <?= esc($totalVisits) ?>

                            <?php endif; ?>

                        </strong>

                        <span class="dashboard-stat-label">

                            <?php if ($isFiltered): ?>

                                pada periode

                            <?php else: ?>

                                seluruh kunjungan

                            <?php endif; ?>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="mb-4">

        <div class="mb-3">

            <h2 class="dashboard-section-title">
                Status Kunjungan
            </h2>

            <p class="dashboard-panel-description">
                Ringkasan kondisi kunjungan tamu saat ini.
            </p>

        </div>


        <div class="glass-card dashboard-panel">

            <div class="dashboard-status-list">

                <div class="dashboard-status-item">

                    <span class="dashboard-status-label">
                        Menunggu
                    </span>

                    <span class="dashboard-status-badge">
                        <?= esc($waiting) ?>
                    </span>

                </div>


                <div class="dashboard-status-item">

                    <span class="dashboard-status-label">
                        Masih Berkunjung
                    </span>

                    <span class="dashboard-status-badge">
                        <?= esc($visiting) ?>
                    </span>

                </div>


                <div class="dashboard-status-item">

                    <span class="dashboard-status-label">
                        Belum Check-out
                    </span>

                    <span class="dashboard-status-badge">
                        <?= esc($notCheckedOut) ?>
                    </span>

                </div>


                <div class="dashboard-status-item">

                    <span class="dashboard-status-label">
                        Selesai
                    </span>

                    <span class="dashboard-status-badge">
                        <?= esc($completed) ?>
                    </span>

                </div>


                <div class="dashboard-status-item">

                    <span class="dashboard-status-label">
                        Ditolak
                    </span>

                    <span class="dashboard-status-badge">
                        <?= esc($rejected) ?>
                    </span>

                </div>


                <div class="dashboard-status-item">

                    <span class="dashboard-status-label">
                        Dibatalkan
                    </span>

                    <span class="dashboard-status-badge">
                        <?= esc($cancelled) ?>
                    </span>

                </div>

            </div>

        </div>

    </div>


    <div class="mb-4">

        <div class="mb-3">

            <h2 class="dashboard-section-title">
                Grafik Kunjungan
            </h2>

            <p class="dashboard-panel-description">
                Visualisasi aktivitas kunjungan berdasarkan hari dan jam kedatangan.
            </p>

        </div>


        <div class="row g-4">

            <div class="col-lg-8">

                <div class="glass-card dashboard-panel h-100">

                    <div class="dashboard-panel-header">

                        <div>

                            <h3 class="dashboard-section-title">
                                Kunjungan Harian
                            </h3>

                            <p class="dashboard-panel-description">
                                Jumlah kunjungan setiap hari pada bulan berjalan.
                            </p>

                        </div>

                    </div>


                    <div class="dashboard-chart-wrapper">

                        <canvas id="dailyVisitsChart"></canvas>

                    </div>

                </div>

            </div>


            <div class="col-lg-4">

                <div class="glass-card dashboard-panel h-100">

                    <div class="dashboard-panel-header">

                        <div>

                            <h3 class="dashboard-section-title">
                                Jam Kunjungan
                            </h3>

                            <p class="dashboard-panel-description">
                                Waktu kunjungan berdasarkan jam kedatangan.
                            </p>

                        </div>

                    </div>


                    <div class="dashboard-chart-wrapper">

                        <canvas id="hourlyVisitsChart"></canvas>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="mb-4">

        <div class="glass-card dashboard-panel">

            <div class="dashboard-panel-header">

                <div>

                    <h2 class="dashboard-section-title">
                        Kunjungan Berdasarkan Bagian
                    </h2>

                    <p class="dashboard-panel-description">
                        Lima bagian dengan jumlah kunjungan terbanyak.
                    </p>

                </div>

            </div>


            <?php if (! empty($departmentVisits)): ?>

                <div class="dashboard-chart-wrapper dashboard-chart-wrapper--bar">

                    <canvas id="departmentVisitsChart"></canvas>

                </div>

            <?php else: ?>

                <div class="dashboard-empty-state">

                    <div class="dashboard-empty-icon">

                        <i class="bi bi-bar-chart"></i>

                    </div>

                    <h3 class="dashboard-empty-title">
                        Belum ada data kunjungan
                    </h3>

                    <p class="dashboard-empty-description">
                        Belum terdapat data kunjungan berdasarkan bagian.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>


    <div class="mb-4">

        <div class="glass-card dashboard-panel">

            <div class="dashboard-panel-header">

                <div>

                    <h2 class="dashboard-section-title">
                        Kunjungan Terbaru
                    </h2>

                    <p class="dashboard-panel-description">
                        Lima kunjungan terbaru yang masuk ke sistem.
                    </p>

                </div>


                <a
                    href="<?= site_url('petugas/bukutamu-kunjungan') ?>"
                    class="btn btn-sm btn-outline-primary">

                    <i class="bi bi-list-ul"></i>
                    Lihat Semua

                </a>

            </div>


            <?php if (! empty($latestVisits)): ?>

                <div class="dashboard-monitoring-table-wrapper">

                    <table class="dashboard-monitoring-table">

                        <thead>

                            <tr>

                                <th>
                                    Kode
                                </th>

                                <th>
                                    Tamu
                                </th>

                                <th>
                                    Tujuan
                                </th>

                                <th>
                                    Waktu Datang
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php foreach ($latestVisits as $visit): ?>

                                <?php
                                $statusClass = match ($visit['status']) {
                                    'Menunggu' => 'dashboard-monitoring-status',
                                    'Masih Berkunjung' => 'dashboard-monitoring-status',
                                    'Belum Check-out' => 'dashboard-monitoring-status dashboard-monitoring-status--warning',
                                    'Selesai' => 'dashboard-monitoring-status',
                                    'Ditolak' => 'dashboard-monitoring-status dashboard-monitoring-status--warning',
                                    'Dibatalkan' => 'dashboard-monitoring-status',
                                    default => 'dashboard-monitoring-status',
                                };
                                ?>

                                <tr>

                                    <td>

                                        <strong>
                                            <?= esc($visit['visit_code']) ?>
                                        </strong>

                                    </td>


                                    <td>

                                        <div class="dashboard-monitoring-guest">

                                            <strong>
                                                <?= esc($visit['guest_name']) ?>
                                            </strong>

                                        </div>

                                    </td>


                                    <td>

                                        <div>
                                            <?= esc($visit['purpose_name']) ?>
                                        </div>

                                        <small>
                                            <?= esc($visit['employee_name']) ?>
                                        </small>

                                    </td>


                                    <td>

                                        <?= date(
                                            'd-m-Y H:i',
                                            strtotime($visit['arrival_time'])
                                        ) ?>

                                    </td>


                                    <td>

                                        <span class="<?= $statusClass ?>">
                                            <?= esc($visit['status']) ?>
                                        </span>

                                    </td>


                                    <td>

                                        <a
                                            href="<?= site_url('petugas/bukutamu-kunjungan/detail/' . $visit['id']) ?>"
                                            class="btn btn-sm btn-outline-primary">

                                            <i class="bi bi-eye"></i>
                                            Detail

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else: ?>

                <div class="dashboard-empty-state">

                    <div class="dashboard-empty-icon">

                        <i class="bi bi-inbox"></i>

                    </div>

                    <h3 class="dashboard-empty-title">
                        Belum ada data kunjungan
                    </h3>

                    <p class="dashboard-empty-description">
                        Belum terdapat data kunjungan yang masuk ke sistem.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>


    <div class="mb-4">

        <div class="glass-card dashboard-panel">

            <div class="dashboard-panel-header">

                <div>

                    <h2 class="dashboard-section-title">
                        Kunjungan Terlalu Lama
                    </h2>

                    <p class="dashboard-panel-description">

                        Kunjungan yang sudah melewati batas waktu
                        <?= esc($warningLimit) ?> menit.

                    </p>

                </div>


                <?php if (! empty($tooLongVisits)): ?>

                    <span class="dashboard-monitoring-status dashboard-monitoring-status--warning">

                        <?= count($tooLongVisits) ?>
                        perlu diperhatikan

                    </span>

                <?php endif; ?>

            </div>


            <?php if (! empty($tooLongVisits)): ?>

                <div class="dashboard-monitoring-table-wrapper">

                    <table class="dashboard-monitoring-table">

                        <thead>

                            <tr>

                                <th>
                                    Kode
                                </th>

                                <th>
                                    Tamu
                                </th>

                                <th>
                                    Departemen
                                </th>

                                <th>
                                    Pegawai
                                </th>

                                <th>
                                    Check-in
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php foreach ($tooLongVisits as $visit): ?>

                                <?php
                                $statusClass = match ($visit['status']) {
                                    'Masih Berkunjung' => 'dashboard-monitoring-status',
                                    'Belum Check-out' => 'dashboard-monitoring-status dashboard-monitoring-status--warning',
                                    default => 'dashboard-monitoring-status',
                                };
                                ?>

                                <tr>

                                    <td>

                                        <strong>
                                            <?= esc($visit['visit_code']) ?>
                                        </strong>

                                    </td>


                                    <td>

                                        <div class="dashboard-monitoring-guest">

                                            <strong>
                                                <?= esc($visit['guest_name']) ?>
                                            </strong>

                                        </div>

                                    </td>


                                    <td>
                                        <?= esc($visit['department_name']) ?>
                                    </td>


                                    <td>
                                        <?= esc($visit['employee_name']) ?>
                                    </td>


                                    <td>

                                        <?php if ($visit['check_in']): ?>

                                            <?= date(
                                                'd-m-Y H:i',
                                                strtotime($visit['check_in'])
                                            ) ?>

                                        <?php else: ?>

                                            -

                                        <?php endif; ?>

                                    </td>


                                    <td>

                                        <span class="<?= $statusClass ?>">
                                            <?= esc($visit['status']) ?>
                                        </span>

                                    </td>


                                    <td>

                                        <a
                                            href="<?= site_url('petugas/bukutamu-kunjungan/detail/' . $visit['id']) ?>"
                                            class="btn btn-sm btn-outline-primary">

                                            <i class="bi bi-eye"></i>
                                            Detail

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else: ?>

                <div class="dashboard-empty-state">

                    <div class="dashboard-empty-icon">

                        <i class="bi bi-check-circle"></i>

                    </div>

                    <h3 class="dashboard-empty-title">
                        Tidak ada kunjungan yang melewati batas waktu
                    </h3>

                    <p class="dashboard-empty-description">
                        Semua kunjungan masih berada dalam batas waktu yang ditentukan.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </div>


    <!-- Modal Filter Dashboard -->

    <div
        class="modal fade dashboard-filter-modal"
        id="dashboardFilterModal"
        tabindex="-1"
        aria-labelledby="dashboardFilterModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <div>

                        <h5
                            class="modal-title"
                            id="dashboardFilterModalLabel">

                            <i class="bi bi-funnel-fill"></i>
                            Filter Dashboard

                        </h5>

                        <p class="dashboard-filter-modal-description">
                            Tentukan periode data yang ingin ditampilkan.
                        </p>

                    </div>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>

                </div>


                <form
                    method="get"
                    action="<?= current_url() ?>">

                    <div class="modal-body">

                        <div class="dashboard-filter-field">

                            <label
                                for="startDate"
                                class="dashboard-filter-label">

                                Mulai Tanggal

                            </label>

                            <input
                                type="date"
                                id="startDate"
                                name="start_date"
                                class="form-control dashboard-filter-input"
                                value="<?= esc($filterStartDate) ?>"
                                required>

                        </div>


                        <div class="dashboard-filter-field">

                            <label
                                for="endDate"
                                class="dashboard-filter-label">

                                Sampai Tanggal

                            </label>

                            <input
                                type="date"
                                id="endDate"
                                name="end_date"
                                class="form-control dashboard-filter-input"
                                value="<?= esc($filterEndDate) ?>"
                                required>

                        </div>

                    </div>


                    <div class="modal-footer">

                        <a
                            href="<?= current_url() ?>"
                            class="btn dashboard-filter-reset-button">

                            <i class="bi bi-arrow-counterclockwise"></i>
                            Reset

                        </a>

                        <button
                            type="submit"
                            class="btn dashboard-filter-apply-button">

                            <i class="bi bi-check-lg"></i>
                            Terapkan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>


<?= $this->section('pageJs') ?>

<script>
    window.petugasDashboardData = {
        dailyVisits: <?= json_encode($dailyVisits) ?>,
        hourlyVisits: <?= json_encode($hourlyVisits) ?>,
        departmentVisits: <?= json_encode($departmentVisits) ?>
    };
</script>

<script src="<?= base_url('assets/js/petugas-dashboard.js') ?>"></script>

<?= $this->endSection() ?>