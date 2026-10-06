<div class="row g-4">

    <div class="col-lg-6">

        <div class="glass-card p-4">

            <h5 class="mb-4">
                Data Tamu
            </h5>

            <div class="mb-3">

                <small class="text-muted">
                    Nama Lengkap
                </small>

                <div class="fw-semibold">
                    <?= esc($visit['guest_name']) ?>
                </div>

            </div>

            <div class="mb-3">

                <small class="text-muted">
                    Nomor HP
                </small>

                <div>
                    <?= esc($visit['phone']) ?>
                </div>

            </div>

            <div class="mb-3">

                <small class="text-muted">
                    Alamat
                </small>

                <div>
                    <?= esc($visit['address']) ?>
                </div>

            </div>

            <div>

                <small class="text-muted">
                    Asal Instansi / Perusahaan
                </small>

                <div>
                    <?= esc($visit['institution']) ?>
                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="glass-card p-4">

            <h5 class="mb-4">
                Data Kunjungan
            </h5>

            <div class="mb-3">

                <small class="text-muted">
                    Kode Kunjungan
                </small>

                <div class="fw-semibold">
                    <?= esc($visit['visit_code']) ?>
                </div>

            </div>

            <div class="mb-3">

                <small class="text-muted">
                    Bagian / Departemen
                </small>

                <div>
                    <?= esc($visit['department_name']) ?>
                </div>

            </div>

            <div class="mb-3">

                <small class="text-muted">
                    Pegawai Tujuan
                </small>

                <div>
                    <?= esc($visit['employee_name']) ?>
                </div>

            </div>

            <div class="mb-3">

                <small class="text-muted">
                    Tujuan Kunjungan
                </small>

                <div>
                    <?= esc($visit['purpose_name']) ?>
                </div>

            </div>

            <div class="mb-3">

                <small class="text-muted">
                    Jumlah Rombongan
                </small>

                <div>
                    <?= esc($visit['group_size']) ?> orang
                </div>

            </div>

            <div>

                <small class="text-muted">
                    Status
                </small>

                <div class="mt-1">

                    <?php
                    $statusClass = match ($visit['status']) {
                        'Menunggu' => 'bg-warning text-dark',
                        'Masih Berkunjung' => 'bg-success',
                        'Selesai' => 'bg-secondary',
                        'Ditolak' => 'bg-danger',
                        'Dibatalkan' => 'bg-secondary',
                        default => 'bg-secondary',
                    };
                    ?>

                    <span class="badge <?= $statusClass ?>">
                        <?= esc($visit['status']) ?>
                    </span>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="glass-card p-4">

            <h5 class="mb-4">
                Waktu Kunjungan
            </h5>

            <div class="mb-3">

                <small class="text-muted">
                    Waktu Pengajuan
                </small>

                <div>
                    <?= esc($visit['arrival_time']) ?>
                </div>

            </div>

            <div class="mb-3">

                <small class="text-muted">
                    Check-In
                </small>

                <div>
                    <?= $visit['check_in']
                        ? esc($visit['check_in'])
                        : '-' ?>
                </div>

            </div>

            <div class="mb-3">

                <small class="text-muted">
                    Check-Out
                </small>

                <div>
                    <?= $visit['check_out']
                        ? esc($visit['check_out'])
                        : '-' ?>
                </div>

            </div>

            <div>

                <small class="text-muted">
                    Durasi Kunjungan
                </small>

                <div>
                    <?= $visit['duration'] !== null
                        ? esc($visit['duration']) . ' menit'
                        : '-' ?>
                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-6">

        <div class="glass-card p-4">

            <h5 class="mb-4">
                Identitas & Persetujuan
            </h5>

            <div class="mb-3">

                <small class="text-muted">
                    Jenis Identitas
                </small>

                <div>
                    <?= esc($visit['identity_type']) ?>
                </div>

            </div>

            <div class="mb-3">

                <small class="text-muted">
                    Nomor Identitas
                </small>

                <div>
                    <?= esc($visit['identity_no']) ?>
                </div>

            </div>

            <div>

                <small class="text-muted">
                    Persetujuan Penggunaan Data
                </small>

                <div>

                    <?php if ((int) $visit['consent'] === 1): ?>

                        <span class="badge bg-success">
                            Disetujui
                        </span>

                    <?php else: ?>

                        <span class="badge bg-secondary">
                            Belum Disetujui
                        </span>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>