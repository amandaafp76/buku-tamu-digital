document.addEventListener(
    'DOMContentLoaded',
    () => {

        const form =
            document.getElementById(
                'guestRegisterForm'
            );

        if (!form) {
            return;
        }


        const namaLengkap =
            document.getElementById(
                'nama_lengkap'
            );

        const nomorHp =
            document.getElementById(
                'nomor_hp'
            );

        const alamat =
            document.getElementById(
                'alamat'
            );

        const asalInstansi =
            document.getElementById(
                'asal_instansi'
            );

        const groupSize =
            document.getElementById(
                'group_size'
            );

        const jenisIdentitas =
            document.getElementById(
                'jenis_identitas'
            );

        const nomorIdentitas =
            document.getElementById(
                'nomor_identitas'
            );


        const namaLengkapError =
            document.getElementById(
                'namaLengkapError'
            );

        const nomorHpError =
            document.getElementById(
                'nomorHpError'
            );

        const alamatError =
            document.getElementById(
                'alamatError'
            );

        const asalInstansiError =
            document.getElementById(
                'asalInstansiError'
            );

        const groupSizeError =
            document.getElementById(
                'groupSizeError'
            );

        const jenisIdentitasError =
            document.getElementById(
                'jenisIdentitasError'
            );

        const nomorIdentitasError =
            document.getElementById(
                'nomorIdentitasError'
            );

        if (nomorHp) {

            nomorHp.addEventListener(
                'input',
                () => {

                    nomorHp.value =
                        nomorHp.value.replace(
                            /[^0-9+]/g,
                            ''
                        );

                }
            );

        }

        if (nomorIdentitas) {

            nomorIdentitas.addEventListener(
                'input',
                () => {

                    nomorIdentitas.value =
                        nomorIdentitas.value.replace(
                            /[^a-zA-Z0-9]/g,
                            ''
                        );

                }
            );

        }

        function showError(
            input,
            errorElement,
            message
        ) {

            input.classList.add(
                'is-invalid'
            );

            if (errorElement) {

                errorElement.textContent =
                    message;

                errorElement.classList.add(
                    'is-visible'
                );

            }

        }

        function clearError(
            input,
            errorElement
        ) {

            input.classList.remove(
                'is-invalid'
            );

            if (errorElement) {

                errorElement.textContent =
                    '';

                errorElement.classList.remove(
                    'is-visible'
                );

            }

        }
        form.addEventListener(
            'submit',
            (event) => {

                event.preventDefault();

                let isValid = true;

                const namaValue =
                    namaLengkap.value.trim();

                if (namaValue === '') {

                    showError(
                        namaLengkap,
                        namaLengkapError,
                        'Nama Lengkap wajib diisi.'
                    );

                    isValid = false;

                } else if (
                    namaValue.length > 100
                ) {

                    showError(
                        namaLengkap,
                        namaLengkapError,
                        'Nama Lengkap maksimal 100 karakter.'
                    );

                    isValid = false;

                } else {

                    clearError(
                        namaLengkap,
                        namaLengkapError
                    );

                }

                const phoneValue =
                    nomorHp.value.trim();

                if (phoneValue === '') {

                    showError(
                        nomorHp,
                        nomorHpError,
                        'Nomor HP wajib diisi.'
                    );

                    isValid = false;

                } else if (
                    phoneValue.length < 10
                ) {

                    showError(
                        nomorHp,
                        nomorHpError,
                        'Nomor HP terlalu pendek. Masukkan minimal 10 digit.'
                    );

                    isValid = false;

                } else if (
                    phoneValue.length > 15
                ) {

                    showError(
                        nomorHp,
                        nomorHpError,
                        'Nomor HP maksimal 15 karakter.'
                    );

                    isValid = false;

                } else if (
                    !/^[0-9+]+$/.test(phoneValue)
                ) {

                    showError(
                        nomorHp,
                        nomorHpError,
                        'Nomor HP hanya boleh berisi angka dan tanda +.'
                    );

                    isValid = false;

                } else {

                    clearError(
                        nomorHp,
                        nomorHpError
                    );

                }

                const alamatValue =
                    alamat.value.trim();

                if (alamatValue === '') {

                    showError(
                        alamat,
                        alamatError,
                        'Alamat wajib diisi.'
                    );

                    isValid = false;

                } else if (
                    alamatValue.length > 150
                ) {

                    showError(
                        alamat,
                        alamatError,
                        'Alamat maksimal 150 karakter.'
                    );

                    isValid = false;

                } else {

                    clearError(
                        alamat,
                        alamatError
                    );

                }

                const asalInstansiValue =
                    asalInstansi.value.trim();

                if (
                    asalInstansiValue === ''
                ) {

                    showError(
                        asalInstansi,
                        asalInstansiError,
                        'Asal Instansi / Perusahaan wajib diisi.'
                    );

                    isValid = false;

                } else if (
                    asalInstansiValue.length > 100
                ) {

                    showError(
                        asalInstansi,
                        asalInstansiError,
                        'Asal Instansi / Perusahaan maksimal 100 karakter.'
                    );

                    isValid = false;

                } else {

                    clearError(
                        asalInstansi,
                        asalInstansiError
                    );

                }
                const groupValue =
                    groupSize.value.trim();

                if (groupValue === '') {

                    showError(
                        groupSize,
                        groupSizeError,
                        'Jumlah Rombongan wajib diisi.'
                    );

                    isValid = false;

                } else if (
                    !/^[0-9]+$/.test(groupValue) ||
                    Number(groupValue) <= 0
                ) {

                    showError(
                        groupSize,
                        groupSizeError,
                        'Jumlah Rombongan harus berupa angka lebih dari 0.'
                    );

                    isValid = false;

                } else if (
                    Number(groupValue) > 999
                ) {

                    showError(
                        groupSize,
                        groupSizeError,
                        'Jumlah Rombongan maksimal 999 orang.'
                    );

                    isValid = false;

                } else {

                    clearError(
                        groupSize,
                        groupSizeError
                    );

                }


                /*
                 * ==========================
                 * JENIS IDENTITAS
                 * ==========================
                 */

                if (
                    !jenisIdentitas.value
                ) {

                    showError(
                        jenisIdentitas,
                        jenisIdentitasError,
                        'Jenis Identitas wajib dipilih.'
                    );

                    isValid = false;

                } else {

                    clearError(
                        jenisIdentitas,
                        jenisIdentitasError
                    );

                }

                const identityValue =
                    nomorIdentitas.value.trim();

                if (identityValue === '') {

                    showError(
                        nomorIdentitas,
                        nomorIdentitasError,
                        'Nomor Identitas wajib diisi.'
                    );

                    isValid = false;

                } else if (
                    identityValue.length > 30
                ) {

                    showError(
                        nomorIdentitas,
                        nomorIdentitasError,
                        'Nomor Identitas maksimal 30 karakter.'
                    );

                    isValid = false;

                } else if (
                    !/^[a-zA-Z0-9]+$/.test(
                        identityValue
                    )
                ) {

                    showError(
                        nomorIdentitas,
                        nomorIdentitasError,
                        'Nomor Identitas hanya boleh berisi huruf dan angka.'
                    );

                    isValid = false;

                } else {

                    clearError(
                        nomorIdentitas,
                        nomorIdentitasError
                    );

                }

                if (!isValid) {
                    return;
                }
                form.submit();

            }
        );

    }
);