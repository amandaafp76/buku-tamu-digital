function bindInstitutionEditModal() {

    const openButton =
        document.getElementById(
            'openInstitutionEdit'
        );

    const overlay =
        document.getElementById(
            'institutionModalOverlay'
        );

    const container =
        document.getElementById(
            'institutionModalContainer'
        );


    if (
        !openButton ||
        !overlay ||
        !container
    ) {
        return;
    }


    const modalUrl =
        openButton.dataset.modalUrl;


    if (!modalUrl) {
        return;
    }


    const openModal = async () => {

        try {

            openButton.disabled =
                true;


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
                    'Gagal memuat form edit institusi.'
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
                'modal-open'
            );


            bindInstitutionModalContent();


        } catch (error) {

            console.error(
                'Institution edit modal error:',
                error
            );


            alert(
                'Form edit identitas institusi gagal dimuat.'
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

                closeInstitutionModal();

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

                closeInstitutionModal();

            }

        }
    );

}


function closeInstitutionModal() {

    const overlay =
        document.getElementById(
            'institutionModalOverlay'
        );


    const container =
        document.getElementById(
            'institutionModalContainer'
        );


    if (
        !overlay ||
        !container
    ) {
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
        'modal-open'
    );

}


function bindInstitutionModalContent() {

    bindInstitutionFormValidation();


    const closeButton =
        document.getElementById(
            'closeInstitutionEdit'
        );


    if (closeButton) {

        closeButton.addEventListener(
            'click',
            closeInstitutionModal
        );

    }


    const cancelButton =
        document.getElementById(
            'cancelInstitutionEdit'
        );


    if (cancelButton) {

        cancelButton.addEventListener(
            'click',
            closeInstitutionModal
        );

    }


    const logoInput =
        document.getElementById(
            'institutionLogo'
        );


    const newLogoPreview =
        document.getElementById(
            'institutionNewLogoPreview'
        );


    const newLogoPreviewImage =
        document.getElementById(
            'institutionNewLogoPreviewImage'
        );


    if (
        logoInput &&
        newLogoPreview &&
        newLogoPreviewImage
    ) {

        logoInput.addEventListener(
            'change',
            () => {

                const file =
                    logoInput.files &&
                    logoInput.files[0];


                if (!file) {

                    clearLogoPreview();

                    return;

                }


                const allowedTypes = [
                    'image/png',
                    'image/jpeg',
                    'image/webp'
                ];


                if (
                    !allowedTypes.includes(
                        file.type
                    )
                ) {

                    showInstitutionLogoError(
                        logoInput,
                        'Format logo harus PNG, JPG/JPEG, atau WebP.'
                    );

                    clearLogoPreview();

                    return;

                }


                if (
                    file.size >
                    2 * 1024 * 1024
                ) {

                    showInstitutionLogoError(
                        logoInput,
                        'Ukuran logo maksimal 2 MB.'
                    );

                    clearLogoPreview();

                    return;

                }


                clearInstitutionFieldError(
                    logoInput,
                    'institutionLogoError'
                );


                const reader =
                    new FileReader();


                reader.onload =
                    (event) => {

                        newLogoPreviewImage.src =
                            event.target.result;


                        newLogoPreview.style.display =
                            'flex';

                    };


                reader.readAsDataURL(
                    file
                );

            }
        );

    }


    function clearLogoPreview() {

        if (newLogoPreview) {

            newLogoPreview.style.display =
                'none';

        }


        if (newLogoPreviewImage) {

            newLogoPreviewImage.src =
                '';

        }


        if (logoInput) {

            logoInput.value =
                '';

        }

    }

}


function bindInstitutionFormValidation() {

    const form =
        document.getElementById(
            'institutionEditForm'
        );


    if (!form) {
        return;
    }


    const name =
        document.getElementById(
            'institutionName'
        );


    const address =
        document.getElementById(
            'institutionAddress'
        );


    const phone =
        document.getElementById(
            'institutionPhone'
        );


    const email =
        document.getElementById(
            'institutionEmail'
        );


    const logo =
        document.getElementById(
            'institutionLogo'
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


    function getErrorElement(
        id
    ) {

        return document.getElementById(
            id
        );

    }


    function validateName() {

        if (!name) {
            return true;
        }


        const value =
            name.value.trim();


        const errorElement =
            getErrorElement(
                'institutionNameError'
            );


        if (value === '') {

            showError(
                name,
                errorElement,
                'Nama instansi wajib diisi.'
            );


            return false;

        }


        if (value.length > 100) {

            showError(
                name,
                errorElement,
                'Nama instansi maksimal 100 karakter.'
            );


            return false;

        }


        clearError(
            name,
            errorElement
        );


        return true;

    }


    function validateAddress() {

        if (!address) {
            return true;
        }


        const value =
            address.value.trim();


        const errorElement =
            getErrorElement(
                'institutionAddressError'
            );


        if (
            value.length > 1000
        ) {

            showError(
                address,
                errorElement,
                'Alamat maksimal 1000 karakter.'
            );


            return false;

        }


        clearError(
            address,
            errorElement
        );


        return true;

    }


    function validatePhone() {

        if (!phone) {
            return true;
        }


        const value =
            phone.value.trim();


        const errorElement =
            getErrorElement(
                'institutionPhoneError'
            );


        if (
            value.length > 17
        ) {

            showError(
                phone,
                errorElement,
                'Nomor telepon maksimal 17 karakter.'
            );


            return false;

        }


        clearError(
            phone,
            errorElement
        );


        return true;

    }


    function validateEmail() {

        if (!email) {
            return true;
        }


        const value =
            email.value.trim();


        const errorElement =
            getErrorElement(
                'institutionEmailError'
            );


        if (value === '') {

            clearError(
                email,
                errorElement
            );


            return true;

        }


        if (
            value.length > 60
        ) {

            showError(
                email,
                errorElement,
                'Email maksimal 60 karakter.'
            );


            return false;

        }


        const emailPattern =
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


        if (
            !emailPattern.test(
                value
            )
        ) {

            showError(
                email,
                errorElement,
                'Format email tidak valid.'
            );


            return false;

        }


        clearError(
            email,
            errorElement
        );


        return true;

    }


    function validateLogo() {

        if (!logo) {
            return true;
        }


        const errorElement =
            getErrorElement(
                'institutionLogoError'
            );


        const file =
            logo.files &&
            logo.files[0];


        if (!file) {

            clearError(
                logo,
                errorElement
            );


            return true;

        }


        const allowedTypes = [
            'image/png',
            'image/jpeg',
            'image/webp'
        ];


        if (
            !allowedTypes.includes(
                file.type
            )
        ) {

            showError(
                logo,
                errorElement,
                'Format logo harus PNG, JPG/JPEG, atau WebP.'
            );


            return false;

        }


        if (
            file.size >
            2 * 1024 * 1024
        ) {

            showError(
                logo,
                errorElement,
                'Ukuran logo maksimal 2 MB.'
            );


            return false;

        }


        clearError(
            logo,
            errorElement
        );


        return true;

    }


    function clearInstitutionFieldError(
        input,
        errorElementId
    ) {

        if (!input) {
            return;
        }


        const errorElement =
            getErrorElement(
                errorElementId
            );


        clearError(
            input,
            errorElement
        );

    }


    function showInstitutionLogoError(
        input,
        message
    ) {

        const errorElement =
            getErrorElement(
                'institutionLogoError'
            );


        showError(
            input,
            errorElement,
            message
        );

    }


    form.addEventListener(
        'submit',
        async function (event) {

            event.preventDefault();


            const nameValid =
                validateName();


            const addressValid =
                validateAddress();


            const phoneValid =
                validatePhone();


            const emailValid =
                validateEmail();


            const logoValid =
                validateLogo();


            if (
                !nameValid ||
                !addressValid ||
                !phoneValid ||
                !emailValid ||
                !logoValid
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
                        'institutionModalContainer'
                    );


                if (!container) {
                    return;
                }


                container.innerHTML =
                    html;


                bindInstitutionModalContent();


            } catch (error) {

                console.error(
                    'Gagal menyimpan identitas institusi:',
                    error
                );


                alert(
                    'Terjadi kesalahan saat menyimpan identitas institusi.'
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

        bindInstitutionEditModal();

    }
);