<?php
$currentUri = uri_string();
?>

<aside class="dashboard-sidebar"
    id="dashboardSidebar">

    <div class="sidebar-brand">
        <a
            href="<?= base_url('admin/bukutamu-dashboard') ?>"
            class="sidebar-brand-link">

            <span class="sidebar-brand-icon">
                <i class="bi bi-journal-bookmark"></i>
            </span>

            <span class="sidebar-brand-text">
                Buku Tamu
            </span>

        </a>

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

        <a
            href="#"
            class="sidebar-nav-item">

            <span class="sidebar-nav-icon">
                <i class="bi bi-database"></i>
            </span>

            <span class="sidebar-nav-text">
                Data Master
            </span>

        </a>

        <a
            href="#"
            class="sidebar-nav-item">

            <span class="sidebar-nav-icon">
                <i class="bi bi-calendar2-check"></i>
            </span>

            <span class="sidebar-nav-text">
                Data Kunjungan
            </span>

        </a>

        <a
            href="#"
            class="sidebar-nav-item">

            <span class="sidebar-nav-icon">
                <i class="bi bi-file-earmark-bar-graph"></i>
            </span>

            <span class="sidebar-nav-text">
                Laporan
            </span>

        </a>

        <a
            href="#"
            class="sidebar-nav-item">

            <span class="sidebar-nav-icon">
                <i class="bi bi-clock-history"></i>
            </span>

            <span class="sidebar-nav-text">
                Activity Log
            </span>

        </a>

        <a
            href="#"
            class="sidebar-nav-item">

            <span class="sidebar-nav-icon">
                <i class="bi bi-gear"></i>
            </span>

            <span class="sidebar-nav-text">
                Pengaturan
            </span>

        </a>

    </nav>

    <div class="sidebar-footer">

        <a
            href="<?= base_url('bukutamu-keluar') ?>"
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