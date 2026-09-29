function getUserModalElements() {
    return {
        overlay: document.getElementById('userModalOverlay'),
        container: document.getElementById('userModalContainer')
    };
}

function closeUserModal() {
    const { overlay, container } = getUserModalElements();

    if (!overlay) {
        return;
    }

    overlay.classList.remove('is-open');
    overlay.setAttribute('aria-hidden', 'true');

    document.body.classList.remove('employee-modal-open');

    window.setTimeout(() => {
        if (container) {
            container.innerHTML = '';
        }
    }, 200);
}

function bindUserModalClose() {
    const { overlay } = getUserModalElements();

    if (!overlay) {
        return;
    }

    overlay.querySelector('#closeTambahPengguna')?.addEventListener(
        'click',
        closeUserModal
    );

    overlay.querySelector('#cancelTambahPengguna')?.addEventListener(
        'click',
        closeUserModal
    );

    overlay.querySelector('#closeEditPengguna')?.addEventListener(
        'click',
        closeUserModal
    );

    overlay.querySelector('#cancelEditPengguna')?.addEventListener(
        'click',
        closeUserModal
    );

    overlay.querySelector('#closeHapusPengguna')?.addEventListener(
        'click',
        closeUserModal
    );

    overlay.querySelector('#cancelHapusPengguna')?.addEventListener(
        'click',
        closeUserModal
    );

    overlay.querySelector('#closeResetPassword')?.addEventListener(
        'click',
        closeUserModal
    );

    overlay.querySelector('#cancelResetPassword')?.addEventListener(
        'click',
        closeUserModal
    );

    overlay.querySelector('.employee-modal-overlay-backdrop')?.addEventListener(
        'click',
        closeUserModal
    );
}

function showUserModalLoading(message = 'Memuat formulir...') {
    const { container } = getUserModalElements();

    if (!container) {
        return;
    }

    container.innerHTML = `
        <div class="employee-modal-loading glass-card">
            <i class="bi bi-arrow-repeat"></i>
            <span>${message}</span>
        </div>
    `;
}

function openUserModal() {
    const { overlay } = getUserModalElements();

    if (!overlay) {
        return;
    }

    overlay.classList.add('is-open');
    overlay.setAttribute('aria-hidden', 'false');

    document.body.classList.add('employee-modal-open');
}

function setUserModalContent(html) {
    const { container } = getUserModalElements();

    if (!container) {
        return;
    }

    container.innerHTML = html;
    bindUserModalClose();
}

function showUserModalError(message, retryCallback = null) {
    const { container } = getUserModalElements();

    if (!container) {
        return;
    }

    container.innerHTML = `
        <div class="employee-modal-error glass-card">
            <i class="bi bi-exclamation-circle"></i>

            <p>${message}</p>

            ${
                retryCallback
                    ? `
                        <button
                            type="button"
                            class="btn employee-button-secondary rounded-pill"
                            id="retryUserModal">
                            Coba Lagi
                        </button>
                    `
                    : `
                        <button
                            type="button"
                            class="btn employee-button-secondary rounded-pill"
                            id="closeUserModalError">
                            Tutup
                        </button>
                    `
            }
        </div>
    `;

    if (retryCallback) {
        document
            .getElementById('retryUserModal')
            ?.addEventListener('click', retryCallback);
    } else {
        document
            .getElementById('closeUserModalError')
            ?.addEventListener('click', closeUserModal);
    }
}

function clearUserClientValidation(form) {
    if (!form) {
        return;
    }

    form.querySelectorAll('.user-client-error').forEach((element) => {
        element.remove();
    });

    form.querySelectorAll('.is-invalid').forEach((element) => {
        element.classList.remove('is-invalid');
    });
}

function showUserFieldError(field, message) {
    if (!field) {
        return;
    }

    field.classList.add('is-invalid');

    const error = document.createElement('div');

    error.className = 'invalid-feedback d-block user-client-error';
    error.textContent = message;

    field.insertAdjacentElement('afterend', error);
}

function focusFirstUserInvalidField(form) {
    form?.querySelector('.is-invalid')?.focus();
}

function isValidUserPassword(password) {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/.test(
        password
    );
}

function validateUserCreateForm(form) {
    clearUserClientValidation(form);

    let valid = true;

    const username = form.querySelector('[name="username"]');
    const password = form.querySelector('[name="password"]');
    const passwordConfirm = form.querySelector(
        '[name="password_confirm"]'
    );
    const role = form.querySelector('[name="role"]');
    const active = form.querySelector('[name="active"]');

    const usernameValue = username?.value.trim() || '';
    const passwordValue = password?.value || '';
    const passwordConfirmValue = passwordConfirm?.value || '';

    if (usernameValue === '') {
        showUserFieldError(
            username,
            'Email wajib diisi.'
        );
        valid = false;
    } else if (usernameValue.length > 100) {
        showUserFieldError(
            username,
            'Email maksimal 100 karakter.'
        );
        valid = false;
    } else if (
        !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(usernameValue)
    ) {
        showUserFieldError(
            username,
            'Email harus menggunakan alamat email yang valid.'
        );
        valid = false;
    }

    if (passwordValue === '') {
        showUserFieldError(
            password,
            'Password wajib diisi.'
        );
        valid = false;
    } else if (passwordValue.length < 8) {
        showUserFieldError(
            password,
            'Password minimal 8 karakter.'
        );
        valid = false;
    } else if (passwordValue.length > 72) {
        showUserFieldError(
            password,
            'Password maksimal 72 karakter.'
        );
        valid = false;
            } else if (!isValidUserPassword(passwordValue)) {
        showUserFieldError(
            password,
            'Password harus mengandung huruf besar, huruf kecil, angka, dan minimal 1 karakter khusus.'
        );
        valid = false;
    }

    if (passwordConfirmValue === '') {
        showUserFieldError(
            passwordConfirm,
            'Konfirmasi Password wajib diisi.'
        );
        valid = false;
    } else if (passwordConfirmValue !== passwordValue) {
        showUserFieldError(
            passwordConfirm,
            'Konfirmasi Password tidak sama dengan Password.'
        );
        valid = false;
    }

    if (!role || !['administrator', 'petugas'].includes(role.value)) {
        showUserFieldError(
            role,
            'Role wajib dipilih.'
        );
        valid = false;
    }

    if (!active || !['0', '1'].includes(active.value)) {
        showUserFieldError(
            active,
            'Status wajib dipilih.'
        );
        valid = false;
    }

    if (!valid) {
        focusFirstUserInvalidField(form);
    }

    return valid;
}

function validateUserEditForm(form) {
    clearUserClientValidation(form);

    let valid = true;

    const username = form.querySelector('[name="username"]');
    const password = form.querySelector('[name="password"]');
    const passwordConfirm = form.querySelector(
        '[name="password_confirm"]'
    );
    const role = form.querySelector('[name="role"]');
    const active = form.querySelector('[name="active"]');

    const usernameValue = username?.value.trim() || '';
    const passwordValue = password?.value || '';
    const passwordConfirmValue = passwordConfirm?.value || '';

    if (usernameValue === '') {
        showUserFieldError(
            username,
            'Email wajib diisi.'
        );
        valid = false;
    } else if (usernameValue.length > 100) {
        showUserFieldError(
            username,
            'Email maksimal 100 karakter.'
        );
        valid = false;
    } else if (
        !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(usernameValue)
    ) {
        showUserFieldError(
            username,
            'Email harus menggunakan alamat email yang valid.'
        );
        valid = false;
    }

    if (!role || !['administrator', 'petugas'].includes(role.value)) {
        showUserFieldError(
            role,
            'Role wajib dipilih.'
        );
        valid = false;
    }

    if (!active || !['0', '1'].includes(active.value)) {
        showUserFieldError(
            active,
            'Status wajib dipilih.'
        );
        valid = false;
    }

    if (passwordValue !== '' || passwordConfirmValue !== '') {
        if (passwordValue.length < 8) {
            showUserFieldError(
                password,
                'Password minimal 8 karakter.'
            );
            valid = false;
        } else if (passwordValue.length > 72) {
            showUserFieldError(
                password,
                'Password maksimal 72 karakter.'
            );
            valid = false;
        } else if (!isValidUserPassword(passwordValue)) {
            showUserFieldError(
                password,
                'Password harus mengandung huruf besar, huruf kecil, angka, dan minimal 1 karakter khusus.'
            );
            valid = false;
        }

        if (passwordConfirmValue === '') {
            showUserFieldError(
                passwordConfirm,
                'Konfirmasi Password wajib diisi.'
            );
            valid = false;
        } else if (passwordConfirmValue !== passwordValue) {
            showUserFieldError(
                passwordConfirm,
                'Konfirmasi Password tidak sama dengan Password.'
            );
            valid = false;
        }
    }

    if (!valid) {
        focusFirstUserInvalidField(form);
    }

    return valid;
}

function validateUserResetPasswordForm(form) {
    clearUserClientValidation(form);

    let valid = true;

    const password = form.querySelector('[name="password"]');
    const passwordConfirm = form.querySelector(
        '[name="password_confirm"]'
    );

    const passwordValue = password?.value || '';
    const passwordConfirmValue = passwordConfirm?.value || '';

    if (passwordValue === '') {
        showUserFieldError(
            password,
            'Password wajib diisi.'
        );
        valid = false;
    } else if (passwordValue.length < 8) {
        showUserFieldError(
            password,
            'Password minimal 8 karakter.'
        );
        valid = false;
    } else if (passwordValue.length > 72) {
        showUserFieldError(
            password,
            'Password maksimal 72 karakter.'
        );
        valid = false;
    } else if (!isValidUserPassword(passwordValue)) {
        showUserFieldError(
            password,
            'Password harus mengandung huruf besar, huruf kecil, angka, dan minimal 1 karakter khusus.'
        );
        valid = false;
    }
    if (passwordConfirmValue === '') {
        showUserFieldError(
            passwordConfirm,
            'Konfirmasi Password wajib diisi.'
        );
        valid = false;
    } else if (passwordConfirmValue !== passwordValue) {
        showUserFieldError(
            passwordConfirm,
            'Konfirmasi Password tidak sama dengan Password.'
        );
        valid = false;
    }

    if (!valid) {
        focusFirstUserInvalidField(form);
    }

    return valid;
}

function bindUserFieldValidation(form, mode = 'edit') {
    if (!form) {
        return;
    }

    const fields = form.querySelectorAll(
        '[name="username"], [name="password"], [name="password_confirm"], [name="role"], [name="active"]'
    );

    fields.forEach((field) => {
        const eventName =
            field.tagName === 'SELECT' ||
            field.type === 'checkbox' ||
            field.type === 'radio'
                ? 'change'
                : 'input';

        field.addEventListener(eventName, () => {
            field.classList.remove('is-invalid');

            field.parentElement
                ?.querySelector('.user-client-error')
                ?.remove();
        });
    });
}

function getUserFormType(form) {
    const action = form?.getAttribute('action') || '';

    if (
        action.includes('/tambah') ||
        action.includes('bukutamu-pengguna/tambah')
    ) {
        return 'create';
    }

    if (
        form?.id === 'formResetPassword' ||
        action.includes('reset-password') ||
        action.includes('reset_password')
    ) {
        return 'reset';
    }

    return 'edit';
}

function validateUserForm(form) {
    const type = getUserFormType(form);

    if (type === 'create') {
        return validateUserCreateForm(form);
    }

    if (type === 'reset') {
        return validateUserResetPasswordForm(form);
    }

    return validateUserEditForm(form);
}

function restoreUserSubmitButton(button, originalHtml) {
    if (!button) {
        return;
    }

    button.disabled = false;
    button.classList.remove('is-loading');
    button.innerHTML = originalHtml;
}

function setUserSubmitLoading(button, text) {
    if (!button) {
        return;
    }

    button.disabled = true;
    button.classList.add('is-loading');

    button.innerHTML = `
        <span
            class="spinner-border spinner-border-sm me-2"
            aria-hidden="true">
        </span>
        ${text}
    `;
}

async function submitUserModalForm(form, submitText = 'Menyimpan...') {
    const submitButton = form.querySelector(
        'button[type="submit"]'
    );

    const originalButtonHtml = submitButton
        ? submitButton.innerHTML
        : '';

    setUserSubmitLoading(
        submitButton,
        submitText
    );

    try {
        const response = await fetch(
            form.action,
            {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                redirect: 'follow'
            }
        );

        if (response.redirected) {
            closeUserModal();
            window.location.assign(response.url);
            return;
        }

        const html = await response.text();

        const { container } = getUserModalElements();

        if (!container) {
            return;
        }

        container.innerHTML = html;

        bindUserModalClose();
        bindUserDynamicContent();

    } catch (error) {
        console.error(
            'Gagal memproses form pengguna:',
            error
        );

        const { container } = getUserModalElements();

        if (container) {
            const existingAlert =
                container.querySelector(
                    '.employee-form-alert'
                );

            existingAlert?.remove();

            const alert = document.createElement('div');

            alert.className =
                'employee-form-alert';

            alert.innerHTML = `
                <i class="bi bi-exclamation-circle"></i>
                <span>
                    Terjadi kesalahan saat memproses data pengguna.
                </span>
            `;

            container.prepend(alert);
        }

        restoreUserSubmitButton(
            submitButton,
            originalButtonHtml
        );
    }
}

function bindUserFormSubmit(form) {
    if (!form || form.dataset.userSubmitBound === 'true') {
        return;
    }

    form.dataset.userSubmitBound = 'true';
    form.noValidate = true;

    bindUserFieldValidation(form);

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const valid = validateUserForm(form);

        if (!valid) {
            return;
        }

        const type = getUserFormType(form);

        let submitText = 'Menyimpan...';

        if (type === 'create') {
            submitText = 'Menyimpan...';
        } else if (type === 'reset') {
            submitText = 'Menyimpan...';
        }

        await submitUserModalForm(
            form,
            submitText
        );
    });
}

function bindUserDynamicContent() {
    const { container } = getUserModalElements();

    if (!container) {
        return;
    }

    bindUserModalClose();

    const forms = container.querySelectorAll('form');

    forms.forEach((form) => {
        bindUserFormSubmit(form);
    });
}

async function loadUserModal(url, loadingMessage, errorMessage) {
    const { container } = getUserModalElements();

    if (!container || !url) {
        return;
    }

    openUserModal();

    showUserModalLoading(loadingMessage);

    try {
        const response = await fetch(
            url,
            {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }
        );

        if (!response.ok) {
            throw new Error(
                errorMessage
            );
        }

        const html = await response.text();

        container.innerHTML = html;

        bindUserDynamicContent();

    } catch (error) {
        console.error(error);

        showUserModalError(
            errorMessage,
            () => loadUserModal(
                url,
                loadingMessage,
                errorMessage
            )
        );
    }
}

function bindUserCreateModal() {
    const openButton = document.getElementById(
        'openTambahPengguna'
    );

    if (!openButton || openButton.dataset.userModalBound === 'true') {
        return;
    }

    openButton.dataset.userModalBound = 'true';

    openButton.addEventListener(
        'click',
        () => {
            const modalUrl =
                openButton.dataset.modalUrl;

            if (!modalUrl) {
                return;
            }

            loadUserModal(
                modalUrl,
                'Memuat formulir pengguna...',
                'Gagal memuat formulir pengguna.'
            );
        }
    );
}

function bindUserEditButtons() {
    const buttons = document.querySelectorAll(
        '[data-user-action="edit"][data-user-edit-url]'
    );

    buttons.forEach((button) => {
        if (button.dataset.userEditBound === 'true') {
            return;
        }

        button.dataset.userEditBound = 'true';

        button.addEventListener(
            'click',
            () => {
                loadUserModal(
                    button.dataset.userEditUrl,
                    'Memuat formulir edit pengguna...',
                    'Form edit pengguna gagal dimuat.'
                );
            }
        );
    });
}

function bindUserDeleteButtons() {
    const buttons = document.querySelectorAll(
        '[data-user-action="delete"][data-user-delete-url]'
    );

    buttons.forEach((button) => {
        if (button.dataset.userDeleteBound === 'true') {
            return;
        }

        button.dataset.userDeleteBound = 'true';

        button.addEventListener(
            'click',
            () => {
                openUserDeleteModal(
                    button.dataset.userDeleteUrl
                );
            }
        );
    });
}

async function openUserDeleteModal(deleteUrl) {
    await loadUserModal(
        deleteUrl,
        'Memuat konfirmasi...',
        'Konfirmasi hapus pengguna gagal dimuat.'
    );

    bindUserDeleteModal();
}

function bindUserDeleteModal() {
    const deleteForm = document.getElementById(
        'deleteUserForm'
    );

    if (!deleteForm || deleteForm.dataset.deleteBound === 'true') {
        return;
    }

    deleteForm.dataset.deleteBound = 'true';

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

            setUserSubmitLoading(
                submitButton,
                'Menghapus...'
            );

            try {
                const response = await fetch(
                    deleteForm.action,
                    {
                        method: 'POST',
                        body: new FormData(deleteForm),
                        headers: {
                            'X-Requested-With':
                                'XMLHttpRequest'
                        },
                        redirect: 'follow'
                    }
                );

                if (response.redirected) {
                    closeUserModal();
                    window.location.assign(
                        response.url
                    );
                    return;
                }

                const html = await response.text();

                const { container } =
                    getUserModalElements();

                if (container) {
                    container.innerHTML = html;

                    bindUserDynamicContent();
                    bindUserDeleteModal();
                }

            } catch (error) {
                console.error(
                    'Gagal menghapus pengguna:',
                    error
                );

                restoreUserSubmitButton(
                    submitButton,
                    originalButtonHtml
                );

                const { container } =
                    getUserModalElements();

                if (container) {
                    const alert =
                        document.createElement('div');

                    alert.className =
                        'employee-form-alert';

                    alert.innerHTML = `
                        <i class="bi bi-exclamation-circle"></i>
                        <span>
                            Terjadi kesalahan saat menghapus data pengguna.
                        </span>
                    `;

                    container.prepend(alert);
                }
            }
        }
    );
}

function bindUserResetPasswordButtons() {
    const buttons = document.querySelectorAll(
        '[data-action="reset-password"][data-reset-password-url]'
    );

    buttons.forEach((button) => {
        if (button.dataset.userResetBound === 'true') {
            return;
        }

        button.dataset.userResetBound = 'true';

        button.addEventListener(
            'click',
            () => {
                openUserResetPasswordModal(
                    button.dataset.resetPasswordUrl
                );
            }
        );
    });
}

async function openUserResetPasswordModal(resetUrl) {
    await loadUserModal(
        resetUrl,
        'Memuat form reset password...',
        'Form reset password gagal dimuat.'
    );

    bindUserResetPasswordModal();
}

function bindUserResetPasswordModal() {
    const resetForm = document.getElementById(
        'formResetPassword'
    );

    if (!resetForm || resetForm.dataset.resetBound === 'true') {
        return;
    }

    resetForm.dataset.resetBound = 'true';

    resetForm.noValidate = true;

    bindUserFieldValidation(
        resetForm,
        'reset'
    );

    resetForm.addEventListener(
        'submit',
        async (event) => {
            event.preventDefault();

            const valid =
                validateUserResetPasswordForm(
                    resetForm
                );

            if (!valid) {
                return;
            }

            await submitUserModalForm(
                resetForm,
                'Menyimpan...'
            );
        }
    );
}

function bindUserEscapeKey() {
    if (document.body.dataset.userEscapeBound === 'true') {
        return;
    }

    document.body.dataset.userEscapeBound = 'true';

    document.addEventListener(
        'keydown',
        (event) => {
            if (
                event.key === 'Escape' &&
                document
                    .getElementById('userModalOverlay')
                    ?.classList.contains('is-open')
            ) {
                closeUserModal();
            }
        }
    );
}

function bindUserModalEvents() {
    bindUserCreateModal();
    bindUserEditButtons();
    bindUserDeleteButtons();
    bindUserResetPasswordButtons();
    bindUserEscapeKey();
    bindUserModalClose();
}

if (
    document.readyState === 'loading'
) {
    document.addEventListener(
        'DOMContentLoaded',
        bindUserModalEvents
    );
} else {
    bindUserModalEvents();
}