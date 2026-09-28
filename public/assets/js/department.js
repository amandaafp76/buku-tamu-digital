/* Department Add Modal */

const departmentModalOverlay =
    document.getElementById('departmentModalOverlay');

const departmentModalContainer =
    document.getElementById('departmentModalContainer');

const openTambahDepartemen =
    document.getElementById('openTambahDepartemen');


async function openDepartmentModal() {

    if (
        !departmentModalOverlay ||
        !departmentModalContainer ||
        !openTambahDepartemen
    ) {
        return;
    }

    departmentModalOverlay.classList.add('is-open');

    departmentModalOverlay.setAttribute(
        'aria-hidden',
        'false'
    );

    document.body.classList.add(
        'employee-modal-open'
    );

    departmentModalContainer.innerHTML = `
        <div class="employee-modal-loading glass-card">

            <i class="bi bi-arrow-repeat"></i>

            <span>
                Memuat formulir...
            </span>

        </div>
    `;

    try {

        const response = await fetch(
            openTambahDepartemen.dataset.modalUrl,
            {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }
        );

        if (!response.ok) {
            throw new Error(
                'Gagal memuat formulir.'
            );
        }

        const html = await response.text();

        departmentModalContainer.innerHTML =
            html;

        bindDepartmentModalActions();

    } catch (error) {

        console.error(
            'Gagal memuat form departemen:',
            error
        );

        departmentModalContainer.innerHTML = `
            <div class="employee-modal-error glass-card">

                <i class="bi bi-exclamation-circle"></i>

                <p>
                    Form tambah bagian/departemen
                    gagal dimuat.
                </p>

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="retryTambahDepartemen">

                    Coba Lagi

                </button>

            </div>
        `;

        document
            .getElementById(
                'retryTambahDepartemen'
            )
            ?.addEventListener(
                'click',
                openDepartmentModal
            );
    }
}


function closeDepartmentModal() {

    if (!departmentModalOverlay) {
        return;
    }

    departmentModalOverlay.classList.remove(
        'is-open'
    );

    departmentModalOverlay.setAttribute(
        'aria-hidden',
        'true'
    );

    document.body.classList.remove(
        'employee-modal-open'
    );

    setTimeout(() => {

        if (departmentModalContainer) {

            departmentModalContainer.innerHTML = '';

        }

    }, 200);
}

function bindDepartmentModalActions() {

    document
        .getElementById('closeTambahDepartemen')
        ?.addEventListener(
            'click',
            closeDepartmentModal
        );

    document
        .getElementById('cancelTambahDepartemen')
        ?.addEventListener(
            'click',
            closeDepartmentModal
        );

    const departmentForm =
        departmentModalContainer?.querySelector('form');

    if (!departmentForm) {
        return;
    }

    const departmentNameInput =
        departmentForm.querySelector('#department_name');

    const departmentNameError =
        departmentForm.querySelector('#departmentNameError');

    const departmentActiveInput =
        departmentForm.querySelector('#department_active');

    const departmentActiveError =
        departmentForm.querySelector('#departmentActiveError');

    departmentNameInput?.addEventListener(
        'input',
        () => {

            departmentNameInput.value =
                departmentNameInput.value
                    .replace(/\s+/g, ' ')
                    .replace(/^\s+/, '')
                    .replace(
                        /\b\p{L}/gu,
                        letter => letter.toUpperCase()
                    );

        }
    );

    departmentForm.addEventListener(
        'submit',
        async (event) => {

            event.preventDefault();

            const isNameValid =
                validateDepartmentName(
                    departmentNameInput,
                    departmentNameError
                );

            const isActiveValid =
                validateDepartmentActive(
                    departmentActiveInput,
                    departmentActiveError
                );

            if (!isNameValid) {

                departmentNameInput?.focus();

                return;
            }

            if (!isActiveValid) {

                departmentActiveInput?.focus();

                return;
            }

            const submitButton =
                departmentForm.querySelector(
                    'button[type="submit"]'
                );

            if (submitButton) {

                submitButton.disabled = true;

                submitButton.classList.add(
                    'is-loading'
                );

                submitButton.innerHTML = `
                    <span
                        class="spinner-border spinner-border-sm me-2"
                        aria-hidden="true">
                    </span>
                    Menyimpan...
                `;
            }

            try {

                const response =
                    await fetch(
                        departmentForm.action,
                        {
                            method: 'POST',
                            body: new FormData(
                                departmentForm
                            ),
                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );

                if (response.redirected) {

                    closeDepartmentModal();

                    window.location.href =
                        response.url;

                    return;
                }

                const html =
                    await response.text();

                departmentModalContainer.innerHTML =
                    html;

                bindDepartmentModalActions();

            } catch (error) {

                console.error(
                    'Gagal menyimpan departemen:',
                    error
                );

                alert(
                    'Terjadi kesalahan saat menyimpan data bagian/departemen.'
                );

            } finally {

                const currentSubmitButton =
                    departmentModalContainer
                        ?.querySelector(
                            'button[type="submit"]'
                        );

                if (currentSubmitButton) {

                    currentSubmitButton.disabled =
                        false;

                    currentSubmitButton.classList.remove(
                        'is-loading'
                    );

                }

            }

        }
    );
}


if (openTambahDepartemen) {

    openTambahDepartemen.addEventListener(
        'click',
        openDepartmentModal
    );

}


departmentModalOverlay
    ?.querySelector(
        '.employee-modal-overlay-backdrop'
    )
    ?.addEventListener(
        'click',
        closeDepartmentModal
    );


document.addEventListener(
    'keydown',
    (event) => {

        if (
            event.key === 'Escape' &&
            departmentModalOverlay
                ?.classList
                .contains('is-open')
        ) {

            closeDepartmentModal();

        }

    }
);

    /* Department Edit Modal */

document
    .querySelectorAll(
        '[data-edit-url]'
    )
    .forEach((button) => {

        button.addEventListener(
            'click',
            async () => {

                const url =
                    button.dataset.editUrl;

                if (
                    !departmentModalOverlay ||
                    !departmentModalContainer
                ) {
                    return;
                }

                departmentModalOverlay.classList.add(
                    'is-open'
                );

                departmentModalOverlay.setAttribute(
                    'aria-hidden',
                    'false'
                );

                document.body.classList.add(
                    'employee-modal-open'
                );

                departmentModalContainer.innerHTML = `
                    <div class="employee-modal-loading glass-card">

                        <i class="bi bi-arrow-repeat"></i>

                        <span>
                            Memuat data...
                        </span>

                    </div>
                `;

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
                            'Gagal memuat data.'
                        );
                    }

                    const html =
                        await response.text();

                    departmentModalContainer.innerHTML =
                        html;

                    bindDepartmentEditModal();

                } catch (error) {

                    console.error(
                        'Gagal memuat edit departemen:',
                        error
                    );

                    departmentModalContainer.innerHTML = `
                        <div class="employee-modal-error glass-card">

                            <i class="bi bi-exclamation-circle"></i>

                            <p>
                                Data bagian/departemen
                                gagal dimuat.
                            </p>

                        </div>
                    `;
                }
            }
        );

    });


function bindDepartmentEditModal() {

    document
        .getElementById('closeEditDepartemen')
        ?.addEventListener(
            'click',
            closeDepartmentModal
        );

    document
        .getElementById('cancelEditDepartemen')
        ?.addEventListener(
            'click',
            closeDepartmentModal
        );

    const editForm =
        departmentModalContainer?.querySelector('form');

    if (!editForm) {
        return;
    }

    const nameInput =
        editForm.querySelector('#department_name_edit');

    const nameError =
        editForm.querySelector('#departmentNameEditError');

    const activeInput =
        editForm.querySelector('#department_active_edit');

    const activeError =
        editForm.querySelector('#departmentActiveEditError');

    nameInput?.addEventListener(
        'input',
        () => {

            nameInput.value =
                nameInput.value
                    .replace(/\s+/g, ' ')
                    .replace(/^\s+/, '')
                    .replace(
                        /\b\p{L}/gu,
                        letter => letter.toUpperCase()
                    );

        }
    );

    editForm.addEventListener(
        'submit',
        async (event) => {

            event.preventDefault();

            const isNameValid =
                validateDepartmentName(
                    nameInput,
                    nameError
                );

            const isActiveValid =
                validateDepartmentActive(
                    activeInput,
                    activeError
                );

            if (!isNameValid) {

                nameInput?.focus();

                return;
            }

            if (!isActiveValid) {

                activeInput?.focus();

                return;
            }

            const submitButton =
                editForm.querySelector(
                    'button[type="submit"]'
                );

            if (submitButton) {

                submitButton.disabled = true;

                submitButton.classList.add(
                    'is-loading'
                );

                submitButton.innerHTML = `
                    <span
                        class="spinner-border spinner-border-sm me-2"
                        aria-hidden="true">
                    </span>
                    Menyimpan...
                `;
            }

            try {

                const response =
                    await fetch(
                        editForm.action,
                        {
                            method: 'POST',
                            body: new FormData(
                                editForm
                            ),
                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );

                if (response.redirected) {

                    closeDepartmentModal();

                    window.location.href =
                        response.url;

                    return;
                }

                const html =
                    await response.text();

                departmentModalContainer.innerHTML =
                    html;

                bindDepartmentEditModal();

            } catch (error) {

                console.error(
                    'Gagal memperbarui departemen:',
                    error
                );

                alert(
                    'Terjadi kesalahan saat memperbarui data.'
                );

            } finally {

                const currentSubmitButton =
                    departmentModalContainer
                        ?.querySelector(
                            'button[type="submit"]'
                        );

                if (currentSubmitButton) {

                    currentSubmitButton.disabled =
                        false;

                    currentSubmitButton.classList.remove(
                        'is-loading'
                    );
                }

            }

        }
    );
}

function bindDepartmentDeleteModal() {
    const overlay =
        document.getElementById('departmentModalOverlay');

    const container =
        document.getElementById('departmentModalContainer');

    if (!overlay || !container) {
        return;
    }

    const deleteButtons =
        document.querySelectorAll(
            '[data-action="delete"][data-delete-url]'
        );

    deleteButtons.forEach((button) => {

        button.addEventListener(
            'click',
            async () => {

                const url =
                    button.dataset.deleteUrl;

                if (!url) {
                    return;
                }

                overlay.classList.add('is-open');

                overlay.setAttribute(
                    'aria-hidden',
                    'false'
                );

                document.body.classList.add(
                    'employee-modal-open'
                );

                container.innerHTML = `
                    <div class="employee-modal-loading glass-card">

                        <i class="bi bi-arrow-repeat"></i>

                        <span>
                            Memuat konfirmasi...
                        </span>

                    </div>
                `;

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
                            'Gagal memuat konfirmasi hapus.'
                        );
                    }

                    const html =
                        await response.text();

                    container.innerHTML =
                        html;

                    bindDepartmentDeleteModalActions();

                } catch (error) {

                    console.error(
                        'Gagal memuat konfirmasi hapus departemen:',
                        error
                    );

                    container.innerHTML = `
                        <div class="employee-modal-error glass-card">

                            <i class="bi bi-exclamation-circle"></i>

                            <p>
                                Konfirmasi hapus
                                Bagian/Departemen
                                gagal dimuat.
                            </p>

                        </div>
                    `;
                }
            }
        );

    });
}


function bindDepartmentDeleteModalActions() {

    document
        .getElementById(
            'closeHapusDepartemen'
        )
        ?.addEventListener(
            'click',
            closeDepartmentModal
        );

    document
        .getElementById(
            'cancelHapusDepartemen'
        )
        ?.addEventListener(
            'click',
            closeDepartmentModal
        );

}

function validateDepartmentName(input, errorElement) {

    if (!input || !errorElement) {
        return false;
    }

    const value = input.value.trim();

    input.classList.remove('is-invalid');
    errorElement.textContent = '';

    if (value === '') {

        input.classList.add('is-invalid');

        errorElement.textContent =
            'Nama bagian/departemen wajib diisi.';

        return false;
    }

    if (value.length < 3) {

        input.classList.add('is-invalid');

        errorElement.textContent =
            'Nama bagian/departemen minimal 3 karakter.';

        return false;
    }

    if (value.length > 50) {

        input.classList.add('is-invalid');

        errorElement.textContent =
            'Nama bagian/departemen maksimal 50 karakter.';

        return false;
    }

    const allowedPattern =
        /^[a-zA-ZÀ-ÿ0-9\s&.,()\/-]+$/;

    if (!allowedPattern.test(value)) {

        input.classList.add('is-invalid');

        errorElement.textContent =
            'Nama bagian/departemen mengandung karakter yang tidak valid.';

        return false;
    }

    return true;
}


function validateDepartmentActive(input, errorElement) {

    if (!input || !errorElement) {
        return false;
    }

    const value = input.value;

    input.classList.remove('is-invalid');
    errorElement.textContent = '';

    if (value !== '0' && value !== '1') {

        input.classList.add('is-invalid');

        errorElement.textContent =
            'Status tidak valid.';

        return false;
    }

    return true;
}


bindDepartmentDeleteModal();