<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <div class="mb-4">
        <h1>Dashboard Petugas</h1>

        <p class="text-muted">
            Selamat datang,
            <?= esc(session()->get('username')) ?>.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="glass-card p-4">
                <h5>Daftar Kunjungan</h5>

                <p class="text-muted">
                    Melihat dan mencari data kunjungan.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card p-4">
                <h5>Check-In</h5>

                <p class="text-muted">
                    Memproses kedatangan tamu.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="glass-card p-4">
                <h5>Check-Out</h5>

                <p class="text-muted">
                    Memproses penyelesaian kunjungan.
                </p>
            </div>
        </div>

    </div>

</div>

<?= $this->endSection() ?>