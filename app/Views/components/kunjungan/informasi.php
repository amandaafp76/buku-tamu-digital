<div class="detail-info-grid">

    <!-- ===== DATA TAMU ===== -->

    <div class="glass-card detail-info-card">

        <div class="detail-info-header">

            <div class="detail-info-icon">

                <i class="bi bi-person-badge"></i>

            </div>

            <h2 class="detail-info-title">
                Data Tamu
            </h2>

        </div>


        <div class="detail-info-body">

            <div class="detail-info-row">

                <div class="detail-info-label">
                    Nama Lengkap
                </div>

                <div class="detail-info-value detail-info-value--strong">
                    <?= esc($visit['guest_name']) ?>
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Nomor HP
                </div>

                <div class="detail-info-value">
                    <?= esc($visit['phone']) ?>
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Alamat
                </div>

                <div class="detail-info-value">
                    <?= esc($visit['address']) ?>
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Asal Instansi / Perusahaan
                </div>

                <div class="detail-info-value">
                    <?= esc($visit['institution']) ?>
                </div>

            </div>

        </div>

    </div>


    <!-- ===== DATA KUNJUNGAN ===== -->

    <div class="glass-card detail-info-card">

        <div class="detail-info-header">

            <div class="detail-info-icon">

                <i class="bi bi-clipboard-data"></i>

            </div>

            <h2 class="detail-info-title">
                Data Kunjungan
            </h2>

        </div>


        <div class="detail-info-body">

            <div class="detail-info-row">

                <div class="detail-info-label">
                    Kode Kunjungan
                </div>

                <div class="detail-info-value detail-info-value--code">
                    <?= esc($visit['visit_code']) ?>
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Bagian / Departemen
                </div>

                <div class="detail-info-value">
                    <?= esc($visit['department_name']) ?>
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Pegawai Tujuan
                </div>

                <div class="detail-info-value">
                    <?= esc($visit['employee_name']) ?>
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Tujuan Kunjungan
                </div>

                <div class="detail-info-value">
                    <?= esc($visit['purpose_name']) ?>
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Jumlah Rombongan
                </div>

                <div class="detail-info-value">
                    <?= esc($visit['group_size']) ?> orang
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Status
                </div>

                <div class="detail-info-value">

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

                    <span class="visit-status-badge visit-status-badge--<?= $statusSlug ?>">

                        <?= esc($visit['status']) ?>

                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- ===== WAKTU KUNJUNGAN ===== -->

    <div class="glass-card detail-info-card">

        <div class="detail-info-header">

            <div class="detail-info-icon">

                <i class="bi bi-clock-history"></i>

            </div>

            <h2 class="detail-info-title">
                Waktu Kunjungan
            </h2>

        </div>


        <div class="detail-info-body">

            <div class="detail-info-row">

                <div class="detail-info-label">
                    Waktu Pengajuan
                </div>

                <div class="detail-info-value">
                    <?= esc($visit['arrival_time']) ?>
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Check-In
                </div>

                <div class="detail-info-value">
                    <?= $visit['check_in']
                        ? esc($visit['check_in'])
                        : '-' ?>
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Check-Out
                </div>

                <div class="detail-info-value">
                    <?= $visit['check_out']
                        ? esc($visit['check_out'])
                        : '-' ?>
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Durasi Kunjungan
                </div>

                <div class="detail-info-value detail-info-value--strong">

                    <?= $visit['duration'] !== null
                        ? esc($visit['duration']) . ' menit'
                        : '-' ?>

                </div>

            </div>

        </div>

    </div>


    <!-- ===== IDENTITAS & PERSETUJUAN ===== -->

    <div class="glass-card detail-info-card">

        <div class="detail-info-header">

            <div class="detail-info-icon">

                <i class="bi bi-shield-check"></i>

            </div>

            <h2 class="detail-info-title">
                Identitas & Persetujuan
            </h2>

        </div>


        <div class="detail-info-body">

            <div class="detail-info-row">

                <div class="detail-info-label">
                    Jenis Identitas
                </div>

                <div class="detail-info-value">
                    <?= esc($visit['identity_type']) ?>
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Nomor Identitas
                </div>

                <div class="detail-info-value">
                    <?= esc($visit['identity_no']) ?>
                </div>

            </div>


            <div class="detail-info-row">

                <div class="detail-info-label">
                    Persetujuan Penggunaan Data
                </div>

                <div class="detail-info-value">

                    <?php if ((int) $visit['consent'] === 1): ?>

                        <span class="detail-consent-badge detail-consent-badge--approved">

                            <i class="bi bi-check-circle-fill"></i>
                            Disetujui

                        </span>

                    <?php else: ?>

                        <span class="detail-consent-badge detail-consent-badge--pending">

                            <i class="bi bi-x-circle-fill"></i>
                            Belum Disetujui

                        </span>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>