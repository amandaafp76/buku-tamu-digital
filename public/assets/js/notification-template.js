document.addEventListener('DOMContentLoaded', function () {

    console.log(
        'Notification Template JS aktif'
    );


    const modalOverlay =
        document.getElementById(
            'notificationTemplateModalOverlay'
        );


    const modalContainer =
        document.getElementById(
            'notificationTemplateModalContainer'
        );


    if (!modalOverlay || !modalContainer) {

        console.error(
            'Notification template modal tidak ditemukan.'
        );

        return;
    }


    function openNotificationTemplateModal(url) {

        console.log(
            'Membuka modal:',
            url
        );


        if (!url) {

            console.error(
                'data-modal-url tidak ditemukan.'
            );

            return;
        }


        modalContainer.innerHTML = `
            <div class="employee-modal-loading">

                <div
                    class="spinner-border"
                    role="status">

                    <span class="visually-hidden">
                        Memuat...
                    </span>

                </div>

            </div>
        `;


        modalOverlay.classList.add('is-open');

        modalOverlay.setAttribute(
            'aria-hidden',
            'false'
        );


        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })

        .then(response => {

            console.log(
                'Response:',
                response.status,
                response.url
            );


            if (!response.ok) {

                throw new Error(
                    `HTTP ${response.status}`
                );
            }


            return response.text();

        })

        .then(html => {

            console.log(
                'Modal berhasil dimuat'
            );


            modalContainer.innerHTML = html;

        })

        .catch(error => {

            console.error(
                'Gagal membuka modal:',
                error
            );


            modalContainer.innerHTML = `
                <div class="employee-modal-wrapper">

                    <div class="employee-modal glass-modal">

                        <div class="employee-modal-header">

                            <div class="employee-modal-icon">

                                <i
                                    class="bi bi-exclamation-circle"
                                    aria-hidden="true">
                                </i>

                            </div>


                            <div class="employee-modal-heading">

                                <h2 class="employee-modal-title">
                                    Terjadi Kesalahan
                                </h2>

                                <p class="employee-modal-description">
                                    Form template pesan tidak dapat dimuat.
                                </p>

                            </div>


                            <button
                                type="button"
                                class="employee-modal-close"
                                data-close-notification-template
                                aria-label="Tutup modal">

                                <i
                                    class="bi bi-x-lg"
                                    aria-hidden="true">
                                </i>

                            </button>

                        </div>


                        <div class="employee-modal-body">

                            <p class="text-muted mb-0">
                                Silakan coba lagi.
                            </p>

                        </div>

                    </div>

                </div>
            `;

        });

    }


    function closeNotificationTemplateModal() {

        modalOverlay.classList.remove(
            'is-open'
        );

        modalOverlay.setAttribute(
            'aria-hidden',
            'true'
        );

        modalContainer.innerHTML = '';

    }

    document.addEventListener(
    'submit',
    function (event) {

        const form = event.target.closest(
            '#notificationTemplateForm'
        );

        if (!form) {
            return;
        }

        event.preventDefault();

        const submitButton =
            form.querySelector(
                'button[type="submit"]'
            );

        const originalButtonHtml =
            submitButton
                ? submitButton.innerHTML
                : '';

        if (submitButton) {

            submitButton.disabled = true;

            submitButton.innerHTML = `
                <span
                    class="spinner-border spinner-border-sm me-2"
                    role="status"
                    aria-hidden="true">
                </span>

                Menyimpan...
            `;
        }

        fetch(form.action, {
            method: 'POST',

            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },

            body: new FormData(form)
        })

        .then(response => {

            if (!response.ok) {

                throw new Error(
                    `HTTP ${response.status}`
                );
            }

            return response.text();
        })

        .then(html => {

            if (
                html.includes(
                    'employee-modal-wrapper'
                )
            ) {

                modalContainer.innerHTML = html;

                return;
            }

            window.location.href =
                window.location.href;
        })

        .catch(error => {

            console.error(
                'Gagal menyimpan template:',
                error
            );

            if (submitButton) {

                submitButton.disabled = false;

                submitButton.innerHTML =
                    originalButtonHtml;
            }
        });

    }
);

    document.addEventListener(
        'click',
        function (event) {

            const createButton =
                event.target.closest(
                    '#openNotificationTemplateCreate, #openNotificationTemplateCreateEmpty'
                );


            if (createButton) {

                openNotificationTemplateModal(
                    createButton.dataset.modalUrl
                );

                return;
            }

            const editButton =
                event.target.closest(
                    '[data-notification-template-edit]'
                );


            if (editButton) {

                console.log(
                    'Tombol Edit diklik'
                );


                console.log(
                    'URL:',
                    editButton.dataset.modalUrl
                );


                openNotificationTemplateModal(
                    editButton.dataset.modalUrl
                );

                return;
            }

            const closeButton =
                event.target.closest(
                    '#closeNotificationTemplateEdit,' +
                    '#cancelNotificationTemplateEdit,' +
                    '[data-close-notification-template]'
                );


            if (closeButton) {

                closeNotificationTemplateModal();

                return;
            }

            if (
                event.target.classList.contains(
                    'employee-modal-overlay-backdrop'
                )
            ) {

                closeNotificationTemplateModal();

            }

        }
    );

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape' &&
                modalOverlay.classList.contains('is-open')
            ) {

                closeNotificationTemplateModal();

            }

        }
    );

});