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