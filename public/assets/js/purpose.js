document.addEventListener('DOMContentLoaded', function() {

    const form = document.getElementById('guestPurposeForm');

    const purposeSelect = document.getElementById('purpose_id');
    const departmentSelect = document.getElementById('department_id');
    const employeeSelect = document.getElementById('employee_id');
    const keperluanInput = document.getElementById('keperluan');

    const purposeError = document.getElementById('purposeIdError');
    const departmentError = document.getElementById('departmentIdError');
    const employeeError = document.getElementById('employeeIdError');
    const keperluanError = document.getElementById('keperluanError');

    const employeesUrl = form.dataset.employeesUrl;
    const oldEmployeeId = form.dataset.oldEmployeeId || '';


    function showError(input, errorElement, message) {

        input.classList.add('is-invalid');

        errorElement.textContent = message;
        errorElement.classList.add('is-visible');

    }


    function clearError(input, errorElement) {

        input.classList.remove('is-invalid');

        errorElement.textContent = '';
        errorElement.classList.remove('is-visible');

    }


    function validatePurpose() {

        if (!purposeSelect.value) {

            showError(
                purposeSelect,
                purposeError,
                'Tujuan Kunjungan wajib dipilih.'
            );

            return false;
        }

        clearError(
            purposeSelect,
            purposeError
        );

        return true;
    }


    function validateDepartment() {

        if (!departmentSelect.value) {

            showError(
                departmentSelect,
                departmentError,
                'Bagian / Departemen wajib dipilih.'
            );

            return false;
        }

        clearError(
            departmentSelect,
            departmentError
        );

        return true;
    }


    function validateEmployee() {

        if (!employeeSelect.value) {

            showError(
                employeeSelect,
                employeeError,
                'Pegawai yang Dituju wajib dipilih.'
            );

            return false;
        }

        clearError(
            employeeSelect,
            employeeError
        );

        return true;
    }


    function validateKeperluan() {

        const value = keperluanInput.value.trim();

        if (!value) {

            showError(
                keperluanInput,
                keperluanError,
                'Detail Keperluan wajib diisi.'
            );

            return false;
        }

        if (value.length > 500) {

            showError(
                keperluanInput,
                keperluanError,
                'Detail Keperluan maksimal 500 karakter.'
            );

            return false;
        }

        clearError(
            keperluanInput,
            keperluanError
        );

        return true;
    }


    async function loadEmployees(
        departmentId,
        selectedEmployeeId = ''
    ) {

        employeeSelect.innerHTML = '';

        if (!departmentId) {

            employeeSelect.disabled = true;

            const option = document.createElement('option');

            option.value = '';
            option.textContent = 'Pilih bagian terlebih dahulu';
            option.selected = true;
            option.disabled = true;

            employeeSelect.appendChild(option);

            return;
        }


        employeeSelect.disabled = true;

        const loadingOption = document.createElement('option');

        loadingOption.value = '';
        loadingOption.textContent = 'Memuat pegawai...';
        loadingOption.selected = true;
        loadingOption.disabled = true;

        employeeSelect.appendChild(loadingOption);


        try {

            const response = await fetch(
                employeesUrl + '/' + departmentId,
                {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            );


            if (!response.ok) {

                throw new Error(
                    'Gagal mengambil data pegawai.'
                );

            }


            const employees = await response.json();

            employeeSelect.innerHTML = '';


            if (
                !Array.isArray(employees) ||
                employees.length === 0
            ) {

                const option = document.createElement('option');

                option.value = '';
                option.textContent = 'Tidak ada pegawai aktif';
                option.selected = true;
                option.disabled = true;

                employeeSelect.appendChild(option);

                employeeSelect.disabled = true;

                return;
            }


            const defaultOption = document.createElement('option');

            defaultOption.value = '';
            defaultOption.textContent = 'Pilih pegawai';
            defaultOption.disabled = true;
            defaultOption.selected = !selectedEmployeeId;

            employeeSelect.appendChild(defaultOption);


            employees.forEach(function(employee) {

                const option = document.createElement('option');

                option.value = employee.id;
                option.textContent = employee.employee_name;


                if (
                    selectedEmployeeId &&
                    String(employee.id) === String(selectedEmployeeId)
                ) {

                    option.selected = true;

                }


                employeeSelect.appendChild(option);

            });


            employeeSelect.disabled = false;


        } catch (error) {

            console.error(error);

            employeeSelect.innerHTML = '';

            const option = document.createElement('option');

            option.value = '';
            option.textContent = 'Gagal memuat pegawai';
            option.selected = true;
            option.disabled = true;

            employeeSelect.appendChild(option);

            employeeSelect.disabled = true;

        }

    }


    departmentSelect.addEventListener(
        'change',
        function() {

            clearError(
                departmentSelect,
                departmentError
            );

            clearError(
                employeeSelect,
                employeeError
            );

            loadEmployees(
                this.value
            );

        }
    );


    purposeSelect.addEventListener(
        'change',
        function() {

            validatePurpose();

        }
    );


    employeeSelect.addEventListener(
        'change',
        function() {

            validateEmployee();

        }
    );


    keperluanInput.addEventListener(
        'input',
        function() {

            validateKeperluan();

        }
    );


    form.addEventListener(
        'submit',
        function(event) {

            const purposeValid =
                validatePurpose();

            const departmentValid =
                validateDepartment();

            const employeeValid =
                validateEmployee();

            const keperluanValid =
                validateKeperluan();


            if (
                !purposeValid ||
                !departmentValid ||
                !employeeValid ||
                !keperluanValid
            ) {

                event.preventDefault();

                const firstInvalid =
                    form.querySelector('.is-invalid');

                if (firstInvalid) {

                    firstInvalid.focus();

                }

            }

        }
    );


    const currentDepartmentId =
        departmentSelect.value;


    if (currentDepartmentId) {

        loadEmployees(
            currentDepartmentId,
            oldEmployeeId
        );

    }

});