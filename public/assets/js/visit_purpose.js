const visitPurposeModalOverlay =
    document.getElementById('visitPurposeModalOverlay');

const visitPurposeModalContainer =
    document.getElementById('visitPurposeModalContainer');

const openTambahTujuanKunjungan =
    document.getElementById('openTambahTujuanKunjungan');


async function openVisitPurposeModal() {

    if (
        !visitPurposeModalOverlay ||
        !visitPurposeModalContainer ||
        !openTambahTujuanKunjungan
    ) {
        return;
    }

    visitPurposeModalOverlay.classList.add('is-open');

    visitPurposeModalOverlay.setAttribute(
        'aria-hidden',
        'false'
    );

    document.body.classList.add(
        'employee-modal-open'
    );

    visitPurposeModalContainer.innerHTML = `
        <div class="employee-modal-loading glass-card">

            <i class="bi bi-arrow-repeat"></i>

            <span>
                Memuat formulir...
            </span>

        </div>
    `;

    try {

        const response = await fetch(
            openTambahTujuanKunjungan.dataset.modalUrl,
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

        const html =
            await response.text();

        visitPurposeModalContainer.innerHTML =
            html;

        bindVisitPurposeAddModal();

    } catch (error) {

        console.error(
            'Gagal memuat form tujuan kunjungan:',
            error
        );

        visitPurposeModalContainer.innerHTML = `
            <div class="employee-modal-error glass-card">

                <i class="bi bi-exclamation-circle"></i>

                <p>
                    Form tambah tujuan kunjungan
                    gagal dimuat.
                </p>

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="retryTambahTujuanKunjungan">

                    Coba Lagi

                </button>

            </div>
        `;

        document
            .getElementById(
                'retryTambahTujuanKunjungan'
            )
            ?.addEventListener(
                'click',
                openVisitPurposeModal
            );
    }
}


function closeVisitPurposeModal() {

    if (!visitPurposeModalOverlay) {
        return;
    }

    visitPurposeModalOverlay.classList.remove(
        'is-open'
    );

    visitPurposeModalOverlay.setAttribute(
        'aria-hidden',
        'true'
    );

    document.body.classList.remove(
        'employee-modal-open'
    );

    setTimeout(() => {

        if (visitPurposeModalContainer) {

            visitPurposeModalContainer.innerHTML = '';

        }

    }, 200);
}


function bindVisitPurposeAddModal() {

    document
        .getElementById(
            'closeTambahTujuanKunjungan'
        )
        ?.addEventListener(
            'click',
            closeVisitPurposeModal
        );

    document
        .getElementById(
            'cancelTambahTujuanKunjungan'
        )
        ?.addEventListener(
            'click',
            closeVisitPurposeModal
        );

    const form =
        visitPurposeModalContainer?.querySelector(
            'form'
        );

    if (!form) {
        return;
    }

    const nameInput =
        form.querySelector(
            '#purpose_name'
        );

    const nameError =
        form.querySelector(
            '#purposeNameError'
        );

    const activeInput =
        form.querySelector(
            '#purpose_active'
        );

    const activeError =
        form.querySelector(
            '#purposeActiveError'
        );

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

    form.addEventListener(
        'submit',
        async (event) => {

            event.preventDefault();

            const isNameValid =
                validateVisitPurposeName(
                    nameInput,
                    nameError
                );

            const isActiveValid =
                validateVisitPurposeActive(
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
                form.querySelector(
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
                        form.action,
                        {
                            method: 'POST',
                            body: new FormData(form),
                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );

                if (response.redirected) {

                    closeVisitPurposeModal();

                    window.location.href =
                        response.url;

                    return;
                }

                const html =
                    await response.text();

                visitPurposeModalContainer.innerHTML =
                    html;

                bindVisitPurposeAddModal();

            } catch (error) {

                console.error(
                    'Gagal menyimpan tujuan kunjungan:',
                    error
                );

                alert(
                    'Terjadi kesalahan saat menyimpan data tujuan kunjungan.'
                );

            } finally {

                const currentSubmitButton =
                    visitPurposeModalContainer
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


if (openTambahTujuanKunjungan) {

    openTambahTujuanKunjungan.addEventListener(
        'click',
        openVisitPurposeModal
    );

}


visitPurposeModalOverlay
    ?.querySelector(
        '.employee-modal-overlay-backdrop'
    )
    ?.addEventListener(
        'click',
        closeVisitPurposeModal
    );


document.addEventListener(
    'keydown',
    (event) => {

        if (
            event.key === 'Escape' &&
            visitPurposeModalOverlay
                ?.classList
                .contains('is-open')
        ) {

            closeVisitPurposeModal();

        }

    }
);


async function openVisitPurposeEditModal(editUrl) {

    if (
        !visitPurposeModalOverlay ||
        !visitPurposeModalContainer ||
        !editUrl
    ) {
        return;
    }

    visitPurposeModalOverlay.classList.add(
        'is-open'
    );

    visitPurposeModalOverlay.setAttribute(
        'aria-hidden',
        'false'
    );

    document.body.classList.add(
        'employee-modal-open'
    );

    visitPurposeModalContainer.innerHTML = `
        <div class="employee-modal-loading glass-card">

            <i class="bi bi-arrow-repeat"></i>

            <span>
                Memuat formulir...
            </span>

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

        visitPurposeModalContainer.innerHTML =
            html;

        bindVisitPurposeEditModal();

    } catch (error) {

        console.error(
            'Gagal memuat form edit tujuan kunjungan:',
            error
        );

        visitPurposeModalContainer.innerHTML = `
            <div class="employee-modal-error glass-card">

                <i class="bi bi-exclamation-circle"></i>

                <p>
                    Form edit tujuan kunjungan
                    gagal dimuat.
                </p>

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="retryEditTujuanKunjungan">

                    Coba Lagi

                </button>

            </div>
        `;

        document
            .getElementById(
                'retryEditTujuanKunjungan'
            )
            ?.addEventListener(
                'click',
                () => openVisitPurposeEditModal(editUrl)
            );

    }

}


function bindVisitPurposeEditModal() {

    document
        .getElementById(
            'closeEditTujuanKunjungan'
        )
        ?.addEventListener(
            'click',
            closeVisitPurposeModal
        );

    document
        .getElementById(
            'cancelEditTujuanKunjungan'
        )
        ?.addEventListener(
            'click',
            closeVisitPurposeModal
        );

    const form =
        visitPurposeModalContainer?.querySelector(
            'form'
        );

    if (!form) {
        return;
    }

    const nameInput =
        form.querySelector(
            '#purpose_name_edit'
        );

    const nameError =
        form.querySelector(
            '#purposeNameEditError'
        );

    const activeInput =
        form.querySelector(
            '#purpose_active_edit'
        );

    const activeError =
        form.querySelector(
            '#purposeActiveEditError'
        );

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

    form.addEventListener(
        'submit',
        async (event) => {

            event.preventDefault();

            const isNameValid =
                validateVisitPurposeName(
                    nameInput,
                    nameError
                );

            const isActiveValid =
                validateVisitPurposeActive(
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
                form.querySelector(
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
                        form.action,
                        {
                            method: 'POST',
                            body: new FormData(form),
                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );

                if (response.redirected) {

                    closeVisitPurposeModal();

                    window.location.href =
                        response.url;

                    return;
                }

                const html =
                    await response.text();

                visitPurposeModalContainer.innerHTML =
                    html;

                bindVisitPurposeEditModal();

            } catch (error) {

                console.error(
                    'Gagal menyimpan perubahan tujuan kunjungan:',
                    error
                );

                alert(
                    'Terjadi kesalahan saat menyimpan perubahan tujuan kunjungan.'
                );

            } finally {

                const currentSubmitButton =
                    visitPurposeModalContainer
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


function validateVisitPurposeName(
    input,
    errorElement
) {

    if (!input || !errorElement) {
        return false;
    }

    const value =
        input.value.trim();

    input.classList.remove(
        'is-invalid'
    );

    errorElement.textContent = '';

    if (value === '') {

        input.classList.add(
            'is-invalid'
        );

        errorElement.textContent =
            'Nama tujuan kunjungan wajib diisi.';

        return false;
    }

    if (value.length < 3) {

        input.classList.add(
            'is-invalid'
        );

        errorElement.textContent =
            'Nama tujuan kunjungan minimal 3 karakter.';

        return false;
    }

    if (value.length > 50) {

        input.classList.add(
            'is-invalid'
        );

        errorElement.textContent =
            'Nama tujuan kunjungan maksimal 50 karakter.';

        return false;
    }

    const allowedPattern =
        /^[a-zA-ZÀ-ÿ0-9\s&.,()\/-]+$/;

    if (!allowedPattern.test(value)) {

        input.classList.add(
            'is-invalid'
        );

        errorElement.textContent =
            'Nama tujuan kunjungan mengandung karakter yang tidak valid.';

        return false;
    }

    return true;
}


function validateVisitPurposeActive(
    input,
    errorElement
) {

    if (!input || !errorElement) {
        return false;
    }

    const value =
        input.value;

    input.classList.remove(
        'is-invalid'
    );

    errorElement.textContent = '';

    if (
        value !== '0' &&
        value !== '1'
    ) {

        input.classList.add(
            'is-invalid'
        );

        errorElement.textContent =
            'Status tidak valid.';

        return false;
    }

    return true;
}


const visitPurposeEditButtons =
    document.querySelectorAll(
        '[data-action="edit"][data-edit-url]'
    );


visitPurposeEditButtons.forEach(
    (button) => {

        button.addEventListener(
            'click',
            () => {

                openVisitPurposeEditModal(
                    button.dataset.editUrl
                );

            }
        );

    }
);


async function openVisitPurposeDeleteModal(
    deleteUrl
) {

    if (
        !visitPurposeModalOverlay ||
        !visitPurposeModalContainer ||
        !deleteUrl
    ) {
        return;
    }

    visitPurposeModalOverlay.classList.add(
        'is-open'
    );

    visitPurposeModalOverlay.setAttribute(
        'aria-hidden',
        'false'
    );

    document.body.classList.add(
        'employee-modal-open'
    );

    visitPurposeModalContainer.innerHTML = `
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

        visitPurposeModalContainer.innerHTML =
            html;

        bindVisitPurposeDeleteModal();

    } catch (error) {

        console.error(
            'Gagal memuat konfirmasi hapus tujuan kunjungan:',
            error
        );

        visitPurposeModalContainer.innerHTML = `
            <div class="employee-modal-error glass-card">

                <i class="bi bi-exclamation-circle"></i>

                <p>
                    Konfirmasi hapus tujuan kunjungan
                    gagal dimuat.
                </p>

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="retryHapusTujuanKunjungan">

                    Coba Lagi

                </button>

            </div>
        `;

        document
            .getElementById(
                'retryHapusTujuanKunjungan'
            )
            ?.addEventListener(
                'click',
                () => openVisitPurposeDeleteModal(
                    deleteUrl
                )
            );

    }

}


function bindVisitPurposeDeleteModal() {

    document
        .getElementById(
            'closeHapusTujuanKunjungan'
        )
        ?.addEventListener(
            'click',
            closeVisitPurposeModal
        );

    document
        .getElementById(
            'cancelHapusTujuanKunjungan'
        )
        ?.addEventListener(
            'click',
            closeVisitPurposeModal
        );

    const deleteForm =
        visitPurposeModalContainer?.querySelector(
            '#formHapusTujuanKunjungan'
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
                    Menghapus...
                `;

            }

            try {

                const response =
                    await fetch(
                        deleteForm.action,
                        {
                            method: 'POST',
                            body: new FormData(
                                deleteForm
                            ),
                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );

                if (response.redirected) {

                    closeVisitPurposeModal();

                    window.location.href =
                        response.url;

                    return;

                }

                const html =
                    await response.text();

                visitPurposeModalContainer.innerHTML =
                    html;

                bindVisitPurposeDeleteModal();

            } catch (error) {

                console.error(
                    'Gagal menghapus tujuan kunjungan:',
                    error
                );

                alert(
                    'Terjadi kesalahan saat menghapus tujuan kunjungan.'
                );

            } finally {

                const currentSubmitButton =
                    visitPurposeModalContainer
                        ?.querySelector(
                            '#formHapusTujuanKunjungan button[type="submit"]'
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


const visitPurposeDeleteButtons =
    document.querySelectorAll(
        '[data-action="delete"][data-delete-url]'
    );


visitPurposeDeleteButtons.forEach(
    (button) => {

        button.addEventListener(
            'click',
            () => {

                openVisitPurposeDeleteModal(
                    button.dataset.deleteUrl
                );

            }
        );

    }
);