document.addEventListener('DOMContentLoaded', function () {

    console.log('kunjungan.js berhasil dimuat');

    const form = document.getElementById('kunjunganFilterForm');
    const keywordInput = document.getElementById('kunjunganKeyword');
    const statusInput = document.getElementById('kunjunganStatus');
    const dateInput = document.getElementById('kunjunganDate');
    const resetButton = document.getElementById('resetKunjunganFilter');
    const tableContainer = document.getElementById('kunjunganTableContainer');

    if (
        !form ||
        !keywordInput ||
        !statusInput ||
        !dateInput ||
        !resetButton ||
        !tableContainer
    ) {
        return;
    }

        const loadKunjungan = async function () {

        const params = new URLSearchParams(
            new FormData(form)
        );

        const url =
            form.action + '?' + params.toString();

        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });

        if (!response.ok) {
            throw new Error(
                'Gagal mengambil data kunjungan.'
            );
        }

        const html = await response.text();

        tableContainer.innerHTML = html;
    };

    tableContainer.addEventListener(
        'click',
        async function (event) {

            const paginationLink =
                event.target.closest(
                    '.admin-pagination a'
                );

            if (!paginationLink) {
                return;
            }

            event.preventDefault();

            const url =
                paginationLink.href;

            if (!url) {
                return;
            }

            try {

                const response =
                    await fetch(
                        url,
                        {
                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );

                if (!response.ok) {

                    throw new Error(
                        'Gagal mengambil halaman kunjungan.'
                    );

                }

                const html =
                    await response.text();

                tableContainer.innerHTML =
                    html;

            } catch (error) {

                console.error(
                    'Gagal memuat pagination kunjungan:',
                    error
                );

            }

        }
    );


    let searchTimeout;

    keywordInput.addEventListener('input', function () {

        clearTimeout(searchTimeout);

        searchTimeout = setTimeout(function () {

            loadKunjungan();

        }, 400);

    });

    statusInput.addEventListener('change', function () {

        loadKunjungan();

    });

    dateInput.addEventListener('change', function () {

        loadKunjungan();

    });

    resetButton.addEventListener('click', function () {

        keywordInput.value = '';
        statusInput.value = '';
        dateInput.value = '';

        loadKunjungan();

    });

    const visitModalOverlay = document.getElementById('visitModalOverlay');
const visitModalContainer = document.getElementById('visitModalContainer');

if (visitModalOverlay && visitModalContainer) {

    tableContainer.addEventListener('click', function(event) {
        const editButton = event.target.closest('[data-edit-visit-url]');

        if (!editButton) {
            return;
        }

        event.preventDefault();

        const url = editButton.dataset.editVisitUrl;

        if (!url) {
            return;
        }

        visitModalOverlay.classList.add('is-open');
        visitModalOverlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('employee-modal-open');

        visitModalContainer.innerHTML = `
            <div class="employee-modal-wrapper">
                <div class="employee-modal glass-modal">
                    <div class="employee-modal-loading">
                        <i class="bi bi-arrow-clockwise"></i>
                        <p>Memuat data...</p>
                    </div>
                </div>
            </div>
        `;

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Gagal memuat data.');
                    });
                }
                return response.text();
            })
            .then(html => {
                visitModalContainer.innerHTML = html;
                attachModalHandlers();
            })
            .catch(error => {
                console.error('Error load modal edit:', error);

                visitModalContainer.innerHTML = `
                    <div class="employee-modal-wrapper">
                        <div class="employee-modal glass-modal">
                            <div class="employee-modal-error">
                                <i class="bi bi-exclamation-triangle"></i>
                                <p>${error.message}</p>
                                <button type="button" class="btn employee-button-secondary rounded-pill" id="closeModalError">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                const closeErrorBtn = document.getElementById('closeModalError');
                if (closeErrorBtn) {
                    closeErrorBtn.addEventListener('click', closeVisitModal);
                }
            });
    });

    
    function attachModalHandlers() {
        const closeBtn = document.getElementById('closeEditKunjungan')
            || document.getElementById('closeEditKunjunganPetugas');

        const cancelBtn = document.getElementById('cancelEditKunjungan')
            || document.getElementById('cancelEditKunjunganPetugas');

        if (closeBtn) {
            closeBtn.addEventListener('click', closeVisitModal);
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', closeVisitModal);
        }

        const departmentSelect = document.getElementById('department_id');
        const employeeSelect = document.getElementById('employee_id');

        if (departmentSelect && employeeSelect) {
            const filterEmployees = () => {
                const selectedDepartment = departmentSelect.value;

                Array.from(employeeSelect.options).forEach(option => {
                    if (!option.value) return;

                    const visible = option.dataset.department === selectedDepartment;
                    option.hidden = !visible;
                });

                const selectedOption = employeeSelect.options[employeeSelect.selectedIndex];

                if (selectedOption && selectedOption.value && selectedOption.hidden) {
                    employeeSelect.value = '';
                }
            };

            departmentSelect.addEventListener('change', filterEmployees);
            filterEmployees();
        }
    }

    function closeVisitModal() {
        visitModalOverlay.classList.remove('is-open');
        visitModalOverlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('employee-modal-open');
        visitModalContainer.innerHTML = '';
    }

    const backdrop = visitModalOverlay.querySelector('.employee-modal-overlay-backdrop');

    if (backdrop) {
        backdrop.addEventListener('click', closeVisitModal);
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && visitModalOverlay.classList.contains('is-open')) {
            closeVisitModal();
        }
    });
}

});


