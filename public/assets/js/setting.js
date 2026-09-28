function bindSettingEditModal() {

    const openButton =
        document.getElementById('openSettingEdit') ||
        document.getElementById('openSettingEditEmpty');

    const overlay =
        document.getElementById('settingModalOverlay');

    const container =
        document.getElementById('settingModalContainer');


    if (!openButton || !overlay || !container) {
        return;
    }


    const modalUrl =
        openButton.dataset.modalUrl;


    if (!modalUrl) {
        return;
    }

    const openModal = async () => {

        try {

            openButton.disabled = true;


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
                    'Gagal memuat form konfigurasi.'
                );

            }


            const html =
                await response.text();


            container.innerHTML =
                html;


            overlay.classList.add(
                'is-open'
            );


            overlay.setAttribute(
                'aria-hidden',
                'false'
            );


            document.body.classList.add(
                'employee-modal-open'
            );

            bindSettingModalContent();


        } catch (error) {

            console.error(
                'Setting edit modal error:',
                error
            );


            alert(
                'Form konfigurasi sistem gagal dimuat.'
            );


        } finally {

            openButton.disabled =
                false;

        }

    };

    openButton.addEventListener(
        'click',
        openModal
    );

    overlay.addEventListener(
        'click',
        (event) => {

            if (
                event.target === overlay ||
                event.target.classList.contains(
                    'employee-modal-overlay-backdrop'
                )
            ) {

                closeSettingModal();

            }

        }
    );

    document.addEventListener(
        'keydown',
        (event) => {

            if (
                event.key === 'Escape' &&
                overlay.classList.contains(
                    'is-open'
                )
            ) {

                closeSettingModal();

            }

        }
    );

}

function closeSettingModal() {

    const overlay =
        document.getElementById(
            'settingModalOverlay'
        );


    const container =
        document.getElementById(
            'settingModalContainer'
        );


    if (!overlay || !container) {
        return;
    }


    overlay.classList.remove(
        'is-open'
    );


    overlay.setAttribute(
        'aria-hidden',
        'true'
    );


    container.innerHTML =
        '';


    document.body.classList.remove(
        'employee-modal-open'
    );

}

function bindSettingModalContent() {

    bindSettingFormValidation();

    const closeButton =
        document.getElementById(
            'closeSettingEdit'
        );


    if (closeButton) {

        closeButton.addEventListener(
            'click',
            closeSettingModal
        );

    }

    const cancelButton =
        document.getElementById(
            'cancelSettingEdit'
        );


    if (cancelButton) {

        cancelButton.addEventListener(
            'click',
            closeSettingModal
        );

    }

    const colorPicker =
        document.getElementById(
            'settingPrimaryColorPicker'
        );


    const colorInput =
        document.getElementById(
            'settingPrimaryColor'
        );


    const colorPreview =
        document.getElementById(
            'settingColorPreview'
        );


    if (
        colorPicker &&
        colorInput &&
        colorPreview
    ) {

        colorPicker.addEventListener(
            'input',
            () => {

                const color =
                    colorPicker.value
                        .toUpperCase();


                colorInput.value =
                    color;


                colorPreview.style.backgroundColor =
                    color;

            }
        );

        colorInput.addEventListener(
            'input',
            () => {

                const color =
                    colorInput.value
                        .trim()
                        .toUpperCase();


                if (
                    /^#[0-9A-F]{6}$/.test(
                        color
                    )
                ) {

                    colorPicker.value =
                        color;


                    colorPreview.style.backgroundColor =
                        color;

                }

            }
        );

    }

}

function bindSettingFormValidation() {

    const form =
        document.getElementById(
            'settingEditForm'
        );

    if (!form) {
        return;
    }

    const primaryColor =
        document.getElementById(
            'settingPrimaryColor'
        );

    const photoSize =
        document.getElementById(
            'settingPhotoSize'
        );

    const warningLimit =
        document.getElementById(
            'settingWarningLimit'
        );

    function showError(
        input,
        errorElement,
        message
    ) {

        if (
            !input ||
            !errorElement
        ) {
            return;
        }

        input.classList.add(
            'is-invalid'
        );

        errorElement.classList.add(
            'is-visible'
        );

        errorElement.textContent =
            message;
    }

    function clearError(
        input,
        errorElement
    ) {

        if (
            !input ||
            !errorElement
        ) {
            return;
        }

        input.classList.remove(
            'is-invalid'
        );

        errorElement.classList.remove(
            'is-visible'
        );

        errorElement.textContent =
            '';
    }

    function validatePrimaryColor() {

        if (!primaryColor) {
            return true;
        }

        const value =
            primaryColor.value
                .trim()
                .toUpperCase();

        const errorElement =
            document.getElementById(
                'settingPrimaryColorError'
            );

        if (value === '') {

            showError(
                primaryColor,
                errorElement,
                'Warna utama wajib diisi.'
            );

            return false;
        }

        if (
            !/^#[0-9A-F]{6}$/.test(
                value
            )
        ) {

            showError(
                primaryColor,
                errorElement,
                'Warna utama harus menggunakan format HEX, contoh #9A3F3F.'
            );

            return false;
        }

        primaryColor.value =
            value;

        clearError(
            primaryColor,
            errorElement
        );

        return true;
    }

    function validateNumber(
        input,
        errorElementId,
        label
    ) {

        if (!input) {
            return true;
        }

        const value =
            input.value.trim();

        const errorElement =
            document.getElementById(
                errorElementId
            );

        if (value === '') {

            showError(
                input,
                errorElement,
                `${label} wajib diisi.`
            );

            return false;
        }

        if (!/^\d+$/.test(value)) {

            showError(
                input,
                errorElement,
                `${label} harus berupa angka yang valid.`
            );

            return false;
        }

        clearError(
            input,
            errorElement
        );

        return true;
    }

    form.addEventListener(
        'submit',
        async function (event) {

            event.preventDefault();

            const primaryColorValid =
                validatePrimaryColor();

            const photoSizeValid =
                validateNumber(
                    photoSize,
                    'settingPhotoSizeError',
                    'Ukuran foto'
                );

            const warningLimitValid =
                validateNumber(
                    warningLimit,
                    'settingWarningLimitError',
                    'Batas peringatan'
                );

            if (
                !primaryColorValid ||
                !photoSizeValid ||
                !warningLimitValid
            ) {
                return;
            }

            const submitButton =
                form.querySelector(
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
                        role="status"
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

                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            },

                            body:
                                new FormData(form)
                        }
                    );

                if (response.redirected) {

                    window.location.href =
                        response.url;

                    return;
                }

                const html =
                    await response.text();

                const container =
                    document.getElementById(
                        'settingModalContainer'
                    );

                if (!container) {
                    return;
                }

                container.innerHTML =
                    html;

                bindSettingModalContent();

            } catch (error) {

                console.error(
                    'Gagal menyimpan konfigurasi:',
                    error
                );

                alert(
                    'Terjadi kesalahan saat menyimpan konfigurasi sistem.'
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
    'DOMContentLoaded',
    () => {

        bindSettingEditModal();

    }
);