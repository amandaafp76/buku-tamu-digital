document.addEventListener('DOMContentLoaded', function () {

    const modalElement =
        document.getElementById('confirmationModal');

    const messageElement =
        document.getElementById('confirmationMessage');

    const submitButton =
        document.getElementById('confirmationSubmit');

    if (
        !modalElement ||
        !messageElement ||
        !submitButton
    ) {
        return;
    }

    const confirmationModal =
        new bootstrap.Modal(modalElement);

    let targetForm = null;

    document.addEventListener('click', function (event) {

        const button =
            event.target.closest(
                '[data-confirm-form]'
            );

        if (!button) {
            return;
        }

        event.preventDefault();

        const formId =
            button.dataset.confirmForm;

        const message =
            button.dataset.confirmMessage ||
            'Apakah Anda yakin ingin melanjutkan tindakan ini?';

        const title =
            button.dataset.confirmTitle ||
            'Konfirmasi Tindakan';

        const submitText =
            button.dataset.confirmSubmit ||
            'Ya, Lanjutkan';

        targetForm =
            document.getElementById(formId);

        if (!targetForm) {
            console.error(
                'Form konfirmasi tidak ditemukan:',
                formId
            );

            return;
        }

        document.getElementById(
            'confirmationModalLabel'
        ).textContent = title;

        messageElement.textContent = message;

        submitButton.textContent = submitText;

        confirmationModal.show();

    });


    submitButton.addEventListener(
        'click',
        function () {

            if (!targetForm) {
                return;
            }

            submitButton.disabled = true;

            submitButton.innerHTML = `
                <span
                    class="spinner-border spinner-border-sm me-2">
                </span>
                Memproses...
            `;

            targetForm.submit();

        }
    );


    modalElement.addEventListener(
        'hidden.bs.modal',
        function () {

            targetForm = null;

            submitButton.disabled = false;

            submitButton.textContent =
                'Ya, Lanjutkan';

        }
    );

});