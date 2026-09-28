const sidebar = document.getElementById('dashboardSidebar');
const sidebarToggle = document.getElementById('sidebarToggle');
const sidebarClose = document.getElementById('sidebarClose');

if (sidebar && sidebarToggle) {
    sidebarToggle.addEventListener('click', () => {
        const isClosed = sidebar.classList.toggle('is-closed');

        document.body.classList.toggle(
            'sidebar-closed',
            isClosed
        );

        sidebarToggle.setAttribute(
            'aria-expanded',
            String(!isClosed)
        );
    });
}

if (sidebar && sidebarClose && sidebarToggle) {
    sidebarClose.addEventListener('click', () => {
        sidebar.classList.add('is-closed');

        document.body.classList.add(
            'sidebar-closed'
        );

        sidebarToggle.setAttribute(
            'aria-expanded',
            'false'
        );
    });
}

const masterDataToggle = document.getElementById('masterDataToggle');
const masterDataSubmenu = document.getElementById('masterDataSubmenu');

if (masterDataToggle && masterDataSubmenu) {
    masterDataToggle.addEventListener('click', () => {
        const isOpen = masterDataSubmenu.classList.toggle('is-open');

        masterDataToggle.classList.toggle(
            'is-open',
            isOpen
        );

        masterDataToggle.setAttribute(
            'aria-expanded',
            String(isOpen)
        );
    });

    const masterDataRoutes = [
        'admin/bukutamu-pegawai',
        'admin/bukutamu-departemen',
        'admin/bukutamu-tujuan',
        'admin/bukutamu-pengguna',
    ];

    const currentUri = window.location.pathname
        .replace(/^\/+|\/+$/g, '');

    const isMasterDataPage = masterDataRoutes.some(
        (route) => currentUri.endsWith(route)
    );

    if (isMasterDataPage) {
        masterDataSubmenu.classList.add('is-open');
        masterDataToggle.classList.add('is-open');

        masterDataToggle.setAttribute(
            'aria-expanded',
            'true'
        );
    }
}

const pengaturanToggle =
    document.getElementById('pengaturanToggle');

const pengaturanSubmenu =
    document.getElementById('pengaturanSubmenu');


if (pengaturanToggle && pengaturanSubmenu) {

    const pengaturanRoutes = [
        'admin/bukutamu-konfigurasi',
        'admin/bukutamu-wakita',
        'admin/bukutamu-template-pesan',
        'admin/bukutamu-identitas-institusi',
    ];


    const isPengaturanActive =
        pengaturanRoutes.some(
            (route) =>
                window.location.pathname
                    .replace(/^\/+/, '')
                    .startsWith(route)
        );


    if (isPengaturanActive) {

        pengaturanToggle.setAttribute(
            'aria-expanded',
            'true'
        );

        pengaturanSubmenu.classList.add(
            'is-open'
        );

    }


    pengaturanToggle.addEventListener(
        'click',
        () => {

            const isExpanded =
                pengaturanToggle.getAttribute(
                    'aria-expanded'
                ) === 'true';


            pengaturanToggle.setAttribute(
                'aria-expanded',
                String(!isExpanded)
            );


            pengaturanSubmenu.classList.toggle(
                'is-open',
                !isExpanded
            );

        }
    );

}