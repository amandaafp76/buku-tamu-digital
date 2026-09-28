function bindWakitaEditModal() {

    const overlay =
        document.getElementById('wakitaModalOverlay');

    const container =
        document.getElementById('wakitaModalContainer');

    const openButton =
        document.getElementById('openWakitaEdit');

    const openEmptyButton =
        document.getElementById('openWakitaEditEmpty');


    if (!overlay || !container) {
        return;
    }


    const openModal = async (button) => {

        if (!button) {
            return;
        }


        const modalUrl =
            button.dataset.modalUrl;


        if (!modalUrl) {
            console.error(
                'URL modal WAKITA tidak ditemukan.'
            );

            return;
        }


        button.disabled = true;


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

                <i
                    class="bi bi-arrow-repeat"
                    aria-hidden="true">
                </i>

                <span>
                    Memuat formulir...
                </span>

            </div>
        `;


        try {

            const response = await fetch(
                modalUrl,
                {
                    method: 'GET',

                    headers: {
                        'X-Requested-With':
                            'XMLHttpRequest',

                        'Accept':
                            'text/html'
                    }
                }
            );


            if (!response.ok) {

                throw new Error(
                    `HTTP ${response.status}`
                );

            }


            const html =
                await response.text();


            container.innerHTML =
                html;


        } catch (error) {

            console.error(
                'WAKITA modal error:',
                error
            );


            container.innerHTML = `
                <div class="employee-modal-error glass-card">

                    <i
                        class="bi bi-exclamation-circle"
                        aria-hidden="true">
                    </i>

                    <p class="mb-3">
                        Form konfigurasi WAKITA
                        gagal dimuat.
                    </p>

                    <button
                        type="button"
                        class="btn employee-button-secondary rounded-pill"
                        id="retryWakitaEdit">

                        Coba Lagi

                    </button>

                </div>
            `;


            document
                .getElementById('retryWakitaEdit')
                ?.addEventListener(
                    'click',
                    () => openModal(button)
                );


        } finally {

            button.disabled = false;

        }

    };


    const closeModal = () => {

        overlay.classList.remove(
            'is-open'
        );


        overlay.setAttribute(
            'aria-hidden',
            'true'
        );


        document.body.classList.remove(
            'employee-modal-open'
        );


        container.innerHTML = '';

    };

    if (openButton) {

        openButton.addEventListener(
            'click',
            () => {

                openModal(
                    openButton
                );

            }
        );

    }


    if (openEmptyButton) {

        openEmptyButton.addEventListener(
            'click',
            () => {

                openModal(
                    openEmptyButton
                );

            }
        );

    }

    overlay.addEventListener(
        'click',
        (event) => {

            if (
                event.target === overlay ||
                event.target.classList.contains(
                    'employee-modal-overlay-backdrop'
                )
            ) {

                closeModal();

            }

        }
    );

    document.addEventListener(
        'click',
        (event) => {

            const closeButton =
                event.target.closest(
                    '#closeWakitaEdit'
                );

            const cancelButton =
                event.target.closest(
                    '#cancelWakitaEdit'
                );


            if (
                closeButton ||
                cancelButton
            ) {

                closeModal();

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

                closeModal();

            }

        }
    );

}

document.addEventListener(
    'DOMContentLoaded',
    () => {

        bindWakitaEditModal();

    }
);