<?php
$currentUri = uri_string();
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

        <div class="sidebar-nav-group">

            <button
                type="button"
                class="sidebar-nav-item sidebar-nav-toggle"
                id="masterDataToggle"
                aria-expanded="false"
                aria-controls="masterDataSubmenu">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-database"></i>
                </span>

                <span class="sidebar-nav-text">
                    Data Master
                </span>

                <span class="sidebar-nav-arrow">
                    <i class="bi bi-chevron-down"></i>
                </span>

            </button>

            <div
                class="sidebar-submenu"
                id="masterDataSubmenu">

                <a
                    href="<?= base_url('admin/bukutamu-pegawai') ?>"
                    class="sidebar-submenu-item <?= $currentUri === 'admin/bukutamu-pegawai' ? 'active' : '' ?>">

                    <span class="sidebar-submenu-dot"></span>

                    <span>
                        Pegawai
                    </span>

                </a>

                <a
                    href="<?= base_url('admin/bukutamu-departemen') ?>"
                    class="sidebar-submenu-item <?= $currentUri === 'admin/bukutamu-departemen' ? 'active' : '' ?>">

                    <span class="sidebar-submenu-dot"></span>

                    <span>
                        Bagian/Departemen
                    </span>

                </a>

                <a
                    href="<?= base_url('admin/bukutamu-tujuan') ?>"
                    class="sidebar-submenu-item <?= $currentUri === 'admin/bukutamu-tujuan' ? 'active' : '' ?>">

                    <span class="sidebar-submenu-dot"></span>

                    <span>
                        Tujuan Kunjungan
                    </span>

                </a>

                <a
                    href="<?= base_url('admin/bukutamu-pengguna') ?>"
                    class="sidebar-submenu-item <?= url_is('admin/bukutamu-pengguna*') ? 'active' : '' ?>">

                    <span class="sidebar-submenu-dot"></span>

                    <span>
                        Pengguna
                    </span>

                </a>

            </div>

        </div>

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

        <div class="sidebar-nav-group">

            <button
                type="button"
                class="sidebar-nav-item sidebar-nav-toggle"
                id="pengaturanToggle"
                aria-expanded="false"
                aria-controls="pengaturanSubmenu">

                <span class="sidebar-nav-icon">
                    <i class="bi bi-gear"></i>
                </span>

                <span class="sidebar-nav-text">
                    Pengaturan
                </span>

                <span class="sidebar-nav-arrow">
                    <i class="bi bi-chevron-down"></i>
                </span>

            </button>


            <div
                class="sidebar-submenu"
                id="pengaturanSubmenu">

                <a
                    href="<?= base_url('admin/bukutamu-konfigurasi') ?>"
                    class="sidebar-submenu-item <?= url_is('admin/bukutamu-konfigurasi*') ? 'active' : '' ?>">

                    <span class="sidebar-submenu-dot"></span>

                    <span>
                        Konfigurasi Sistem
                    </span>

                </a>


                <a
                    href="<?= base_url('admin/bukutamu-wakita') ?>"
                    class="sidebar-submenu-item <?= url_is('admin/bukutamu-wakita*') ? 'active' : '' ?>">

                    <span class="sidebar-submenu-dot"></span>

                    <span>
                        WAKITA
                    </span>

                </a>


                <a
                    href="<?= base_url('admin/bukutamu-template-pesan') ?>"
                    class="sidebar-submenu-item <?= url_is('admin/bukutamu-template-pesan*') ? 'active' : '' ?>">

                    <span class="sidebar-submenu-dot"></span>

                    <span>
                        Template Pesan
                    </span>

                </a>


                <a
                    href="<?= base_url('admin/bukutamu-identitas-institusi') ?>"
                    class="sidebar-submenu-item <?= url_is('admin/bukutamu-identitas-institusi*') ? 'active' : '' ?>">

                    <span class="sidebar-submenu-dot"></span>

                    <span>
                        Identitas Institusi
                    </span>

                </a>

            </div>

        </div>

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