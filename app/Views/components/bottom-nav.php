<?php
$userRole = session()->get('role');

if (! in_array($userRole, ['administrator', 'petugas'])) {
    return;
}
?>

<nav
    class="bottom-nav"
    aria-label="Navigasi bawah">

    <?php if ($userRole === 'administrator'): ?>

        <a
            href="<?= site_url('admin/bukutamu-dashboard') ?>"
            class="bottom-nav-item <?= url_is('admin/bukutamu-dashboard*') ? 'active' : '' ?>">

            <i class="bi bi-grid-1x2" aria-hidden="true"></i>
            <span>Dashboard</span>

        </a>

        <a
            href="<?= site_url('admin/bukutamu-kunjungan') ?>"
            class="bottom-nav-item <?= url_is('admin/bukutamu-kunjungan*') ? 'active' : '' ?>">

            <i class="bi bi-calendar2-check" aria-hidden="true"></i>
            <span>Kunjungan</span>

        </a>

        <a
            href="<?= site_url('admin/bukutamu-laporan') ?>"
            class="bottom-nav-item <?= url_is('admin/bukutamu-laporan*') ? 'active' : '' ?>">

            <i class="bi bi-file-earmark-bar-graph" aria-hidden="true"></i>
            <span>Laporan</span>

        </a>

        <a
            href="<?= site_url('admin/bukutamu-konfigurasi') ?>"
            class="bottom-nav-item <?= url_is('admin/bukutamu-konfigurasi*') ? 'active' : '' ?>">

            <i class="bi bi-gear" aria-hidden="true"></i>
            <span>Pengaturan</span>

        </a>

    <?php endif; ?>


    <?php if ($userRole === 'petugas'): ?>

        <a
            href="<?= site_url('petugas/bukutamu-dashboard') ?>"
            class="bottom-nav-item <?= url_is('petugas/bukutamu-dashboard*') ? 'active' : '' ?>">

            <i class="bi bi-grid-1x2" aria-hidden="true"></i>
            <span>Dashboard</span>

        </a>

        <a
            href="<?= site_url('petugas/bukutamu-kunjungan') ?>"
            class="bottom-nav-item <?= url_is('petugas/bukutamu-kunjungan*') ? 'active' : '' ?>">

            <i class="bi bi-calendar2-check" aria-hidden="true"></i>
            <span>Kunjungan</span>

        </a>

        <a
            href="<?= site_url('petugas/bukutamu-scan-qr') ?>"
            class="bottom-nav-item <?= url_is('petugas/bukutamu-scan-qr*') ? 'active' : '' ?>">

            <i class="bi bi-qr-code-scan" aria-hidden="true"></i>
            <span>Scan QR</span>

        </a>

        <a
            href="<?= site_url('petugas/bukutamu-riwayat') ?>"
            class="bottom-nav-item <?= url_is('petugas/bukutamu-riwayat*') ? 'active' : '' ?>">

            <i class="bi bi-clock-history" aria-hidden="true"></i>
            <span>Riwayat</span>

        </a>

    <?php endif; ?>

</nav>