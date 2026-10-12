<?php
$currentUri = uri_string();
$userRole   = session()->get('role');
?>

<aside class="dashboard-sidebar"
    id="dashboardSidebar">

    <div class="sidebar-brand">
        <div class="sidebar-brand-link">

            <span class="sidebar-brand-icon">
                <i class="bi bi-journal-bookmark"></i>
            </span>

            <span class="sidebar-brand-text">
                Buku Tamu
            </span>

        </div>

        <button
            type="button"
            class="sidebar-close-button"
            id="sidebarClose"
            aria-label="Tutup menu navigasi">

            <i
                class="bi bi-list"
                aria-hidden="true">
            </i>

        </button>
    </div>

    <nav class="sidebar-nav" aria-label="Navigasi utama">
        <?php if ($userRole === 'administrator'): ?>

            <div class="sidebar-group-label">
                Menu Utama
            </div>

            <a
                href="<?= base_url('admin/bukutamu-dashboard') ?>"
                class="sidebar-nav-item <?= $currentUri === 'admin/bukutamu-dashboard' ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-grid-1x2"></i>
                </span>

                <span class="sidebar-nav-text">
                    Dashboard
                </span>

            </a>

            <div class="sidebar-group-label">
                Data Master
            </div>

            <a
                href="<?= base_url('admin/bukutamu-pegawai') ?>"
                class="sidebar-nav-item <?= $currentUri === 'admin/bukutamu-pegawai' ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-person-badge"></i>
                </span>

                <span class="sidebar-nav-text">
                    Pegawai
                </span>

            </a>

            <a
                href="<?= base_url('admin/bukutamu-departemen') ?>"
                class="sidebar-nav-item <?= $currentUri === 'admin/bukutamu-departemen' ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-diagram-3"></i>
                </span>

                <span class="sidebar-nav-text">
                    Bagian/Departemen
                </span>

            </a>

            <a
                href="<?= base_url('admin/bukutamu-tujuan') ?>"
                class="sidebar-nav-item <?= $currentUri === 'admin/bukutamu-tujuan' ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-bullseye"></i>
                </span>

                <span class="sidebar-nav-text">
                    Tujuan Kunjungan
                </span>

            </a>

            <a
                href="<?= base_url('admin/bukutamu-pengguna') ?>"
                class="sidebar-nav-item <?= url_is('admin/bukutamu-pengguna*') ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-people"></i>
                </span>

                <span class="sidebar-nav-text">
                    Pengguna
                </span>

            </a>

            <div class="sidebar-group-label">
                Data dan Laporan
            </div>

            <a
                href="<?= base_url('admin/bukutamu-kunjungan') ?>"
                class="sidebar-nav-item <?= url_is('admin/bukutamu-kunjungan*') ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-calendar2-check"></i>
                </span>

                <span class="sidebar-nav-text">
                    Data Kunjungan
                </span>

            </a>

            <a
                href="<?= site_url('admin/bukutamu-laporan') ?>"
                class="sidebar-nav-item <?= url_is('admin/bukutamu-laporan*') ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                </span>

                <span class="sidebar-nav-text">
                    Laporan
                </span>

            </a>

            <div class="sidebar-group-label">
                Activity Log
            </div>

            <a
                href="<?= base_url('admin/bukutamu-activity-log') ?>"
                class="sidebar-nav-item <?= url_is('admin/bukutamu-activity-log') ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-clock-history"></i>
                </span>

                <span class="sidebar-nav-text">
                    Activity Log
                </span>

            </a>

            <div class="sidebar-group-label">
                Pengaturan
            </div>

            <a
                href="<?= base_url('admin/bukutamu-konfigurasi') ?>"
                class="sidebar-nav-item <?= url_is('admin/bukutamu-konfigurasi*') ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-sliders"></i>
                </span>

                <span class="sidebar-nav-text">
                    Konfigurasi Sistem
                </span>

            </a>

            <a
                href="<?= base_url('admin/bukutamu-wakita') ?>"
                class="sidebar-nav-item <?= url_is('admin/bukutamu-wakita*') ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-clock-history"></i>
                </span>

                <span class="sidebar-nav-text">
                    WAKITA
                </span>

            </a>

            <a
                href="<?= base_url('admin/bukutamu-template-pesan') ?>"
                class="sidebar-nav-item <?= url_is('admin/bukutamu-template-pesan*') ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-chat-square-text"></i>
                </span>

                <span class="sidebar-nav-text">
                    Template Pesan
                </span>

            </a>

            <a
                href="<?= base_url('admin/bukutamu-identitas-institusi') ?>"
                class="sidebar-nav-item <?= url_is('admin/bukutamu-identitas-institusi*') ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-building"></i>
                </span>

                <span class="sidebar-nav-text">
                    Identitas Institusi
                </span>

            </a>

        <?php endif; ?>

        <?php if ($userRole === 'petugas'): ?>

            <a
                href="<?= base_url('petugas/bukutamu-dashboard') ?>"
                class="sidebar-nav-item <?= $currentUri === 'petugas/bukutamu-dashboard' ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-grid-1x2"></i>
                </span>

                <span class="sidebar-nav-text">
                    Dashboard
                </span>

            </a>

            <a
                href="<?= base_url('petugas/bukutamu-kunjungan') ?>"
                class="sidebar-nav-item <?= url_is('petugas/bukutamu-kunjungan*') ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-calendar2-check"></i>
                </span>

                <span class="sidebar-nav-text">
                    Data Kunjungan
                </span>

            </a>

            <a
                href="<?= base_url('petugas/bukutamu-scan-qr') ?>"
                class="sidebar-nav-item <?= $currentUri === 'petugas/bukutamu-scan-qr' ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-qr-code-scan"></i>
                </span>

                <span class="sidebar-nav-text">
                    SCAN QR
                </span>

            </a>

            <a
                href="<?= base_url('petugas/bukutamu-riwayat') ?>"
                class="sidebar-nav-item <?= url_is('petugas/bukutamu-riwayat*') ? 'active' : '' ?>">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-clock-history"></i>
                </span>

                <span class="sidebar-nav-text">
                    Riwayat Kunjungan
                </span>

            </a>

        <?php endif; ?>

    </nav>

    <div class="sidebar-footer">

        <a
            href="<?= site_url('bukutamu-keluar') ?>"
            class="sidebar-logout">

            <span class="sidebar-nav-icon">
                <i class="bi bi-box-arrow-right"></i>
            </span>

            <span class="sidebar-nav-text">
                Keluar
            </span>

        </a>

    </div>

</aside>