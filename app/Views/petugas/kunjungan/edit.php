<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <div class="mb-4">

        <a
            href="<?= site_url(
                        'petugas/bukutamu-kunjungan/detail/' . $visit['id']
                    ) ?>"
            class="btn btn-sm btn-outline-secondary mb-3">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>

        <h1>
            Perbaiki Data Kunjungan
        </h1>

        <p class="text-muted">
            Perbaiki data kunjungan yang diperlukan sebelum
            proses verifikasi dan check-in.
        </p>

    </div>


    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger">

            <?= esc(
                session()->getFlashdata('error')
            ) ?>

        </div>

    <?php endif; ?>


    <?php if (session()->getFlashdata('errors')): ?>

        <div class="alert alert-danger">

            <ul class="mb-0">

                <?php foreach (
                    session()->getFlashdata('errors')
                    as $error
                ): ?>

                    <li>
                        <?= esc($error) ?>
                    </li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>


    <div class="glass-card p-4">

        <div class="mb-4">

            <h5 class="mb-1">
                Data yang Dapat Diperbaiki
            </h5>

            <p class="text-muted mb-0">
                Petugas hanya dapat mengubah bagian/departemen,
                pegawai tujuan, keperluan kunjungan, dan jumlah rombongan.
            </p>

        </div>


        <form
            action="<?= site_url(
                        'petugas/bukutamu-kunjungan/update/' . $visit['id']
                    ) ?>"
            method="post">

            <?= csrf_field() ?>


            <div class="row g-4">


                <div class="col-md-6">

                    <label
                        for="department_id"
                        class="form-label">

                        Bagian / Departemen

                    </label>

                    <select
                        name="department_id"
                        id="department_id"
                        class="form-select"
                        required>

                        <option value="">
                            Pilih Bagian / Departemen
                        </option>

                        <?php foreach (
                            $departments as $department
                        ): ?>

                            <option
                                value="<?= esc($department['id']) ?>"
                                <?= (int) old(
                                    'department_id',
                                    $visit['department_id']
                                ) === (int) $department['id']
                                    ? 'selected'
                                    : '' ?>>

                                <?= esc($department['name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <div class="col-md-6">

                    <label
                        for="employee_id"
                        class="form-label">

                        Pegawai Tujuan

                    </label>

                    <select
                        name="employee_id"
                        id="employee_id"
                        class="form-select"
                        required>

                        <option value="">
                            Pilih Pegawai Tujuan
                        </option>

                        <?php foreach (
                            $employees as $employee
                        ): ?>

                            <option
                                value="<?= esc($employee['id']) ?>"
                                data-department="<?= esc(
                                                        $employee['department_id']
                                                    ) ?>"
                                <?= (int) old(
                                    'employee_id',
                                    $visit['employee_id']
                                ) === (int) $employee['id']
                                    ? 'selected'
                                    : '' ?>>

                                <?= esc(
                                    $employee['employee_name']
                                ) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <div class="col-md-6">

                    <label
                        for="purpose_id"
                        class="form-label">

                        Keperluan Kunjungan

                    </label>

                    <select
                        name="purpose_id"
                        id="purpose_id"
                        class="form-select"
                        required>

                        <option value="">
                            Pilih Keperluan Kunjungan
                        </option>

                        <?php foreach (
                            $purposes as $purpose
                        ): ?>

                            <option
                                value="<?= esc($purpose['id']) ?>"
                                <?= (int) old(
                                    'purpose_id',
                                    $visit['purpose_id']
                                ) === (int) $purpose['id']
                                    ? 'selected'
                                    : '' ?>>

                                <?= esc(
                                    $purpose['purpose_name']
                                ) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <div class="col-md-6">

                    <label
                        for="group_size"
                        class="form-label">

                        Jumlah Rombongan

                    </label>

                    <input
                        type="number"
                        name="group_size"
                        id="group_size"
                        class="form-control"
                        min="1"
                        max="100"
                        value="<?= esc(
                                    old(
                                        'group_size',
                                        $visit['group_size']
                                    )
                                ) ?>"
                        required>

                </div>


            </div>


            <div class="d-flex justify-content-end gap-2 mt-4">

                <a
                    href="<?= site_url(
                                'petugas/bukutamu-kunjungan/detail/' . $visit['id']
                            ) ?>"
                    class="btn btn-outline-secondary">

                    Batal

                </a>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-save me-1"></i>
                    Simpan Perubahan

                </button>

            </div>


        </form>

    </div>

</div>

<?= $this->endSection() ?>


<?= $this->section('pageJs') ?>

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const departmentSelect =
                document.getElementById(
                    'department_id'
                );

            const employeeSelect =
                document.getElementById(
                    'employee_id'
                );

            if (
                !departmentSelect ||
                !employeeSelect
            ) {
                return;
            }


            function filterEmployees() {

                const selectedDepartment =
                    departmentSelect.value;

                const currentEmployee =
                    employeeSelect.value;


                Array.from(
                    employeeSelect.options
                ).forEach(function(option) {

                    if (!option.value) {
                        return;
                    }

                    const employeeDepartment =
                        option.dataset.department;

                    const visible =
                        employeeDepartment ===
                        selectedDepartment;

                    option.hidden = !visible;

                });


                const selectedOption =
                    employeeSelect.options[
                        employeeSelect.selectedIndex
                    ];


                if (
                    selectedOption &&
                    selectedOption.value &&
                    selectedOption.hidden
                ) {

                    employeeSelect.value = '';

                }

            }


            departmentSelect.addEventListener(
                'change',
                filterEmployees
            );


            filterEmployees();

        }
    );
</script>

<?= $this->endSection() ?>