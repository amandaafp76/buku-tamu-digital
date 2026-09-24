<nav class="dashboard-navbar">

    <div class="navbar-left">

        <button
            type="button"
            class="navbar-menu-toggle"
            id="sidebarToggle"
            aria-label="Buka menu navigasi"
            aria-controls="dashboardSidebar"
            aria-expanded="true">

            <i class="bi bi-list" aria-hidden="true"></i>

        </button>

        <div class="navbar-page-title">
            <span class="navbar-page-title-text">
                <?= esc($pageTitle ?? 'Dashboard') ?>
            </span>
        </div>

    </div>

    <div class="navbar-right">

        <div class="navbar-search">

            <i
                class="bi bi-search navbar-search-icon"
                aria-hidden="true">
            </i>

            <input
                type="search"
                class="navbar-search-input"
                placeholder="Cari..."
                aria-label="Cari">

        </div>

        <div class="navbar-user">

            <div class="navbar-user-avatar">
                <i
                    class="bi bi-person"
                    aria-hidden="true">
                </i>
            </div>

            <div class="navbar-user-info">

                <span class="navbar-user-name">
                    <?= esc(session()->get('username') ?? 'Pengguna') ?>
                </span>

                <span class="navbar-user-role">
                    <?= esc(ucfirst(session()->get('role') ?? '')) ?>
                </span>

            </div>

        </div>

    </div>

</nav>