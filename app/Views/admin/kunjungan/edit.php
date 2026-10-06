<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <div class="mb-4">

        <a
            href="<?= site_url(
                        'admin/bukutamu-kunjungan/detail/' . $visit['id']
                    ) ?>"
            class="btn btn-sm btn-outline-secondary mb-3">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>

        <h1>
            Edit Data Kunjungan
        </h1>

        <p class="text-muted">
            Administrator dapat memperbaiki data tamu dan data
            kunjungan yang diperlukan.
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


    <form
        action="<?= site_url(
                    'admin/bukutamu-kunjungan/update/' . $visit['id']
                ) ?>"
        method="post">

        <?= csrf_field() ?>


        <div class="glass-card p-4 mb-4">

            <div class="mb-4">

                <h5 class="mb-1">
                    Data Tamu
                </h5>

                <p class="text-muted mb-0">
                    Informasi identitas dasar tamu yang melakukan kunjungan.
                </p>

            </div>


            <div class="row g-4">


                <div class="col-md-6">

                    <label
                        for="guest_name"
                        class="form-label">

                        Nama Lengkap

                    </label>

                    <input
                        type="text"
                        name="guest_name"
                        id="guest_name"
                        class="form-control"
                        value="<?= esc(
                                    old(
                                        'guest_name',
                                        $visit['guest_name']
                                    )
                                ) ?>"
                        required>

                </div>


                <div class="col-md-6">

                    <label
                        for="phone"
                        class="form-label">

                        Nomor HP

                    </label>

                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        class="form-control"
                        value="<?= esc(
                                    old(
                                        'phone',
                                        $visit['phone']
                                    )
                                ) ?>"
                        required>

                </div>


                <div class="col-12">

                    <label
                        for="address"
                        class="form-label">

                        Alamat

                    </label>

                    <textarea
                        name="address"
                        id="address"
                        class="form-control"
                        rows="3"
                        required><?= esc(
                                        old(
                                            'address',
                                            $visit['address']
                                        )
                                    ) ?></textarea>

                </div>


                <div class="col-12">

                    <label
                        for="institution"
                        class="form-label">

                        Asal Instansi / Perusahaan

                    </label>

                    <input
                        type="text"
                        name="institution"
                        id="institution"
                        class="form-control"
                        value="<?= esc(
                                    old(
                                        'institution',
                                        $visit['institution']
                                    )
                                ) ?>"
                        required>

                </div>


            </div>

        </div>

        <div class="glass-card p-4 mb-4">

            <div class="mb-4">

                <h5 class="mb-1">
                    Identitas
                </h5>

                <p class="text-muted mb-0">
                    Perbaiki jenis dan nomor identitas tamu.
                </p>

            </div>


            <div class="row g-4">


                <div class="col-md-6">

                    <label
                        for="identity_type"
                        class="form-label">

                        Jenis Identitas

                    </label>

                    <select
                        name="identity_type"
                        id="identity_type"
                        class="form-select"
                        required>

                        <option
                            value=""
                            disabled
                            <?= empty(old(
                                'identity_type',
                                $visit['identity_type']
                            ))
                                ? 'selected'
                                : '' ?>>

                            Pilih jenis identitas

                        </option>

                        <option
                            value="KTP"
                            <?= old(
                                'identity_type',
                                $visit['identity_type']
                            ) === 'KTP'
                                ? 'selected'
                                : '' ?>>

                            KTP

                        </option>

                        <option
                            value="SIM"
                            <?= old(
                                'identity_type',
                                $visit['identity_type']
                            ) === 'SIM'
                                ? 'selected'
                                : '' ?>>

                            SIM

                        </option>

                        <option
                            value="PASPOR"
                            <?= old(
                                'identity_type',
                                $visit['identity_type']
                            ) === 'PASPOR'
                                ? 'selected'
                                : '' ?>>

                            Paspor

                        </option>

                        <option
                            value="LAINNYA"
                            <?= old(
                                'identity_type',
                                $visit['identity_type']
                            ) === 'LAINNYA'
                                ? 'selected'
                                : '' ?>>

                            Lainnya

                        </option>

                    </select>

                </div>


                <div class="col-md-6">

                    <label
                        for="identity_no"
                        class="form-label">

                        Nomor Identitas

                    </label>

                    <input
                        type="text"
                        name="identity_no"
                        id="identity_no"
                        class="form-control"
                        value="<?= esc(
                                    old(
                                        'identity_no',
                                        $visit['identity_no']
                                    )
                                ) ?>"
                        required>

                </div>


            </div>

        </div>

        <div class="glass-card p-4 mb-4">

            <div class="mb-4">

                <h5 class="mb-1">
                    Data Kunjungan
                </h5>

                <p class="text-muted mb-0">
                    Perbaiki tujuan dan informasi kunjungan tamu.
                </p>

            </div>


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
                                value="<?= esc(
                                            $department['id']
                                        ) ?>"
                                <?= (int) old(
                                    'department_id',
                                    $visit['department_id']
                                ) === (int) $department['id']
                                    ? 'selected'
                                    : '' ?>>

                                <?= esc(
                                    $department['name']
                                ) ?>

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
                                value="<?= esc(
                                            $employee['id']
                                        ) ?>"
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
                                value="<?= esc(
                                            $purpose['id']
                                        ) ?>"
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

        </div>

        <div class="d-flex justify-content-end gap-2">

            <a
                href="<?= site_url(
                            'admin/bukutamu-kunjungan/detail/' . $visit['id']
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