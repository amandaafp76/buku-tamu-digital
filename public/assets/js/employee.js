const employeeModalOverlay =
    document.getElementById('employeeModalOverlay');

const employeeModalContainer =
    document.getElementById('employeeModalContainer');

const openTambahPegawai =
    document.getElementById('openTambahPegawai');


async function openEmployeeModal() {

    if (
        !employeeModalOverlay ||
        !employeeModalContainer ||
        !openTambahPegawai
    ) {
        return;
    }

    const modalUrl =
        openTambahPegawai.dataset.modalUrl;

    if (!modalUrl) {
        return;
    }

    employeeModalOverlay.classList.add('is-open');

    employeeModalOverlay.setAttribute(
        'aria-hidden',
        'false'
    );

    document.body.classList.add(
        'employee-modal-open'
    );

    employeeModalContainer.innerHTML = `
        <div class="employee-modal-loading glass-card">
            <i class="bi bi-arrow-repeat"></i>
            <span>Memuat formulir...</span>
        </div>
    `;

    try {

        const response =
            await fetch(
                modalUrl,
                {
                    headers: {
                        'X-Requested-With':
                            'XMLHttpRequest'
                    }
                }
            );

        if (!response.ok) {
            throw new Error(
                'Gagal memuat formulir.'
            );
        }

        const html =
            await response.text();

        employeeModalContainer.innerHTML =
            html;

        bindEmployeeModalActions();

    } catch (error) {

        console.error(
            'Gagal memuat formulir tambah pegawai:',
            error
        );

        employeeModalContainer.innerHTML = `
            <div class="employee-modal-error glass-card">

                <i class="bi bi-exclamation-circle"></i>

                <p>
                    Form tambah pegawai gagal dimuat.
                </p>

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="retryTambahPegawai">
                    Coba Lagi
                </button>

            </div>
        `;

        document
            .getElementById(
                'retryTambahPegawai'
            )
            ?.addEventListener(
                'click',
                openEmployeeModal
            );
    }
}


function closeEmployeeModal() {

    if (!employeeModalOverlay) {
        return;
    }

    employeeModalOverlay.classList.remove(
        'is-open'
    );

    employeeModalOverlay.setAttribute(
        'aria-hidden',
        'true'
    );

    document.body.classList.remove(
        'employee-modal-open'
    );

    setTimeout(() => {

        if (employeeModalContainer) {
            employeeModalContainer.innerHTML = '';
        }

    }, 200);
}


function bindEmployeeModalActions() {

    document
        .getElementById(
            'closeTambahPegawai'
        )
        ?.addEventListener(
            'click',
            closeEmployeeModal
        );

    document
        .getElementById(
            'cancelTambahPegawai'
        )
        ?.addEventListener(
            'click',
            closeEmployeeModal
        );

    const employeeForm =
        employeeModalContainer?.querySelector(
            'form'
        );

    const phoneInput =
        employeeForm?.querySelector(
            '#phone'
        );

    const employeeNameInput =
        employeeForm?.querySelector(
            '#employee_name'
        );

    if (employeeNameInput) {

        employeeNameInput.addEventListener(
            'input',
            () => {

                employeeNameInput.value =
                    employeeNameInput.value
                        .replace(
                            /[^a-zA-ZÀ-ÿ\s]/g,
                            ''
                        )
                        .replace(
                            /\s+/g,
                            ' '
                        )
                        .replace(
                            /\b\p{L}/gu,
                            (letter) =>
                                letter.toUpperCase()
                        );

            }
        );

    }

    if (phoneInput) {

        phoneInput.addEventListener(
            'input',
            () => {

                phoneInput.value =
                    phoneInput.value.replace(
                        /[^0-9+]/g,
                        ''
                    );

            }
        );

    }

    if (!employeeForm) {
        return;
    }

    employeeForm.addEventListener(
        'submit',
        async (event) => {

            event.preventDefault();

            const submitButton =
                employeeForm.querySelector(
                    'button[type="submit"]'
                );

            const originalButtonHtml =
                submitButton
                    ? submitButton.innerHTML
                    : '';

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
                        employeeForm.action,
                        {
                            method: 'POST',

                            body:
                                new FormData(
                                    employeeForm
                                ),

                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );

                const html =
                    await response.text();

                if (response.redirected) {

                    closeEmployeeModal();

                    window.location.href =
                        response.url;

                    return;
                }

                employeeModalContainer.innerHTML =
                    html;

                bindEmployeeModalActions();

            } catch (error) {

                console.error(
                    'Gagal menyimpan pegawai:',
                    error
                );

                const existingAlert =
                    employeeModalContainer?.querySelector(
                        '.employee-form-alert'
                    );

                existingAlert?.remove();

                const alert =
                    document.createElement(
                        'div'
                    );

                alert.className =
                    'employee-form-alert';

                alert.innerHTML = `
                    <i class="bi bi-exclamation-circle"></i>
                    <span>
                        Terjadi kesalahan saat menyimpan data pegawai.
                    </span>
                `;

                employeeModalContainer?.prepend(
                    alert
                );

                if (submitButton) {

                    submitButton.disabled =
                        false;

                    submitButton.classList.remove(
                        'is-loading'
                    );

                    submitButton.innerHTML =
                        originalButtonHtml;

                }

            }

        }
    );
}


if (openTambahPegawai) {

    openTambahPegawai.addEventListener(
        'click',
        openEmployeeModal
    );

}


employeeModalOverlay
    ?.querySelector(
        '.employee-modal-overlay-backdrop'
    )
    ?.addEventListener(
        'click',
        closeEmployeeModal
    );


document.addEventListener(
    'keydown',
    (event) => {

        if (
            event.key === 'Escape' &&
            employeeModalOverlay?.classList.contains(
                'is-open'
            )
        ) {
            closeEmployeeModal();
        }

    }
);


async function openEditEmployeeModal(
    editUrl
) {

    if (
        !employeeModalOverlay ||
        !employeeModalContainer ||
        !editUrl
    ) {
        return;
    }

    employeeModalOverlay.classList.add(
        'is-open'
    );

    employeeModalOverlay.setAttribute(
        'aria-hidden',
        'false'
    );

    document.body.classList.add(
        'employee-modal-open'
    );

    employeeModalContainer.innerHTML = `
        <div class="employee-modal-loading glass-card">
            <i class="bi bi-arrow-repeat"></i>
            <span>Memuat formulir...</span>
        </div>
    `;

    try {

        const response =
            await fetch(
                editUrl,
                {
                    headers: {
                        'X-Requested-With':
                            'XMLHttpRequest'
                    }
                }
            );

        if (!response.ok) {

            throw new Error(
                'Gagal memuat formulir edit.'
            );

        }

        const html =
            await response.text();

        employeeModalContainer.innerHTML =
            html;

        bindEmployeeEditModalActions();

    } catch (error) {

        console.error(
            'Gagal memuat edit pegawai:',
            error
        );

        employeeModalContainer.innerHTML = `
            <div class="employee-modal-error glass-card">

                <i class="bi bi-exclamation-circle"></i>

                <p>
                    Form edit pegawai gagal dimuat.
                </p>

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="retryEditPegawai">
                    Coba Lagi
                </button>

            </div>
        `;

        document
            .getElementById(
                'retryEditPegawai'
            )
            ?.addEventListener(
                'click',
                () => openEditEmployeeModal(editUrl)
            );

    }
}


function bindEmployeeEditModalActions() {

    document
        .getElementById(
            'closeEditPegawai'
        )
        ?.addEventListener(
            'click',
            closeEmployeeModal
        );

    document
        .getElementById(
            'cancelEditPegawai'
        )
        ?.addEventListener(
            'click',
            closeEmployeeModal
        );

    const employeeForm =
        employeeModalContainer?.querySelector(
            'form'
        );

    if (!employeeForm) {
        return;
    }

    const phoneInput =
        employeeForm.querySelector(
            '#edit_phone'
        );

    const phoneError =
        employeeForm.querySelector(
            '#editPhoneError'
        );

    const employeeNameInput =
        employeeForm.querySelector(
            '#edit_employee_name'
        );

    if (phoneInput) {

        phoneInput.addEventListener(
            'input',
            () => {

                phoneInput.value =
                    phoneInput.value.replace(
                        /[^0-9+]/g,
                        ''
                    );

                phoneInput.classList.remove(
                    'is-invalid'
                );

                phoneError?.classList.remove(
                    'is-visible'
                );

                if (phoneError) {
                    phoneError.textContent = '';
                }

            }
        );

    }

    if (employeeNameInput) {

        employeeNameInput.addEventListener(
            'input',
            () => {

                employeeNameInput.value =
                    employeeNameInput.value
                        .replace(
                            /[^a-zA-ZÀ-ÿ\s]/g,
                            ''
                        )
                        .replace(
                            /\s+/g,
                            ' '
                        )
                        .replace(
                            /\b\p{L}/gu,
                            (letter) =>
                                letter.toUpperCase()
                        );

            }
        );

    }

    function showPhoneError(message) {

        if (!phoneInput) {
            return;
        }

        phoneInput.classList.add(
            'is-invalid'
        );

        if (phoneError) {

            phoneError.classList.add(
                'is-visible'
            );

            phoneError.textContent =
                message;

        }

    }

    function clearPhoneError() {

        if (!phoneInput) {
            return;
        }

        phoneInput.classList.remove(
            'is-invalid'
        );

        if (phoneError) {

            phoneError.classList.remove(
                'is-visible'
            );

            phoneError.textContent = '';

        }

    }

    function validatePhone() {

        if (!phoneInput) {
            return true;
        }

        const value =
            phoneInput.value.trim();

        if (value === '') {

            showPhoneError(
                'Nomor HP wajib diisi.'
            );

            return false;

        }

        if (value.length < 10) {

            showPhoneError(
                'Nomor HP terlalu pendek. Masukkan minimal 10 digit.'
            );

            return false;

        }

        if (value.length > 15) {

            showPhoneError(
                'Nomor HP maksimal 15 karakter.'
            );

            return false;

        }

        if (!/^[0-9+]+$/.test(value)) {

            showPhoneError(
                'Nomor HP hanya boleh berisi angka dan tanda +.'
            );

            return false;

        }

        clearPhoneError();

        return true;
    }

    employeeForm.addEventListener(
        'submit',
        async (event) => {

            event.preventDefault();

            if (!validatePhone()) {
                return;
            }

            const submitButton =
                employeeForm.querySelector(
                    'button[type="submit"]'
                );

            const originalButtonHtml =
                submitButton
                    ? submitButton.innerHTML
                    : '';

            if (submitButton) {

                submitButton.disabled =
                    true;

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
                        employeeForm.action,
                        {
                            method: 'POST',

                            body:
                                new FormData(
                                    employeeForm
                                ),

                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );

                const html =
                    await response.text();

                if (response.redirected) {

                    closeEmployeeModal();

                    window.location.href =
                        response.url;

                    return;
                }

                employeeModalContainer.innerHTML =
                    html;

                bindEmployeeEditModalActions();

            } catch (error) {

                console.error(
                    'Gagal menyimpan perubahan pegawai:',
                    error
                );

                const existingAlert =
                    employeeModalContainer?.querySelector(
                        '.employee-form-alert'
                    );

                existingAlert?.remove();

                const alert =
                    document.createElement(
                        'div'
                    );

                alert.className =
                    'employee-form-alert';

                alert.innerHTML = `
                    <i class="bi bi-exclamation-circle"></i>
                    <span>
                        Terjadi kesalahan saat menyimpan perubahan pegawai.
                    </span>
                `;

                employeeModalContainer?.prepend(
                    alert
                );

                if (submitButton) {

                    submitButton.disabled =
                        false;

                    submitButton.classList.remove(
                        'is-loading'
                    );

                    submitButton.innerHTML =
                        originalButtonHtml;

                }

            }

        }
    );
}


async function openDeleteEmployeeModal(
    deleteUrl
) {

    if (
        !employeeModalOverlay ||
        !employeeModalContainer ||
        !deleteUrl
    ) {
        return;
    }

    employeeModalOverlay.classList.add(
        'is-open'
    );

    employeeModalOverlay.setAttribute(
        'aria-hidden',
        'false'
    );

    document.body.classList.add(
        'employee-modal-open'
    );

    employeeModalContainer.innerHTML = `
        <div class="employee-modal-loading glass-card">
            <i class="bi bi-arrow-repeat"></i>
            <span>Memuat konfirmasi...</span>
        </div>
    `;

    try {

        const response =
            await fetch(
                deleteUrl,
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

        employeeModalContainer.innerHTML =
            html;

        bindDeleteEmployeeModal();

    } catch (error) {

        console.error(
            'Gagal memuat konfirmasi hapus pegawai:',
            error
        );

        employeeModalContainer.innerHTML = `
            <div class="employee-modal-error glass-card">

                <i class="bi bi-exclamation-circle"></i>

                <p>
                    Konfirmasi hapus pegawai gagal dimuat.
                </p>

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="retryDeletePegawai">
                    Coba Lagi
                </button>

            </div>
        `;

        document
            .getElementById(
                'retryDeletePegawai'
            )
            ?.addEventListener(
                'click',
                () => openDeleteEmployeeModal(deleteUrl)
            );

    }
}


function bindDeleteEmployeeModal() {

    document
        .getElementById(
            'closeHapusPegawai'
        )
        ?.addEventListener(
            'click',
            closeEmployeeModal
        );

    document
        .getElementById(
            'cancelHapusPegawai'
        )
        ?.addEventListener(
            'click',
            closeEmployeeModal
        );

    const deleteForm =
        document.getElementById(
            'deleteEmployeeForm'
        );

    if (!deleteForm) {
        return;
    }

    deleteForm.addEventListener(
        'submit',
        async (event) => {

            event.preventDefault();

            const submitButton =
                deleteForm.querySelector(
                    'button[type="submit"]'
                );

            const originalButtonHtml =
                submitButton
                    ? submitButton.innerHTML
                    : '';

            if (submitButton) {

                submitButton.disabled =
                    true;

                submitButton.classList.add(
                    'is-loading'
                );

                submitButton.innerHTML = `
                    <span
                        class="spinner-border spinner-border-sm me-2"
                        aria-hidden="true">
                    </span>
                    Menghapus...
                `;

            }

            try {

                const response =
                    await fetch(
                        deleteForm.action,
                        {
                            method: 'POST',

                            body:
                                new FormData(
                                    deleteForm
                                ),

                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );

                const html =
                    await response.text();

                if (response.redirected) {

                    closeEmployeeModal();

                    window.location.href =
                        response.url;

                    return;
                }

                employeeModalContainer.innerHTML =
                    html;

                bindDeleteEmployeeModal();

            } catch (error) {

                console.error(
                    'Gagal menghapus pegawai:',
                    error
                );

                const existingAlert =
                    employeeModalContainer?.querySelector(
                        '.employee-form-alert'
                    );

                existingAlert?.remove();

                const alert =
                    document.createElement(
                        'div'
                    );

                alert.className =
                    'employee-form-alert';

                alert.innerHTML = `
                    <i class="bi bi-exclamation-circle"></i>
                    <span>
                        Terjadi kesalahan saat menghapus data pegawai.
                    </span>
                `;

                employeeModalContainer?.prepend(
                    alert
                );

                if (submitButton) {

                    submitButton.disabled =
                        false;

                    submitButton.classList.remove(
                        'is-loading'
                    );

                    submitButton.innerHTML =
                        originalButtonHtml;

                }

            }

        }
    );
}


document.addEventListener(
    'click',
    (event) => {

        const editButton =
            event.target.closest(
                '[data-action="edit"][data-edit-url]'
            );

        if (editButton) {

            event.preventDefault();

            openEditEmployeeModal(
                editButton.dataset.editUrl
            );

            return;
        }

        const deleteButton =
            event.target.closest(
                '[data-action="delete"][data-delete-url]'
            );

        if (deleteButton) {

            event.preventDefault();

            openDeleteEmployeeModal(
                deleteButton.dataset.deleteUrl
            );

        }

    }
);