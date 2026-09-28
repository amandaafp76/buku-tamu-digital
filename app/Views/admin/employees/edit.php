<?php
$errors = $errors ?? session()->getFlashdata('errors') ?? [];
$error  = $error ?? session()->getFlashdata('error');
$formData = $formData ?? [];

$employeeName = old(
    'employee_name',
    $formData['employee_name'] ?? $employee['employee_name'] ?? ''
);

$phone = old(
    'phone',
    $formData['phone'] ?? $employee['phone'] ?? ''
);

$departmentId = old(
    'department_id',
    $formData['department_id'] ?? $employee['department_id'] ?? ''
);

$active = old(
    'active',
    $formData['active'] ?? (string) ($employee['active'] ?? '1')
);
?>

<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i class="bi bi-person-gear"></i>
            </div>

            <div class="employee-modal-heading">
                <h1 class="employee-modal-title">
                    Edit Pegawai
                </h1>

                <p class="employee-modal-description">
                    Perbarui data pegawai yang dipilih.
                </p>
            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeEditPegawai"
                aria-label="Tutup">
                <i class="bi bi-x-lg"></i>
            </button>

        </div>

        <?php if ($error): ?>

            <div class="employee-form-alert">
                <i class="bi bi-exclamation-circle"></i>
                <span><?= esc($error) ?></span>
            </div>

        <?php endif; ?>

        <form
            action="<?= base_url('admin/bukutamu-pegawai/edit/' . $employee['id']) ?>"
            method="post">

            <?= csrf_field() ?>

            <div class="employee-modal-body">

                <div class="row g-4">

                    <div class="col-12">

                        <label
                            for="edit_employee_name"
                            class="form-label employee-form-label">
                            Nama Pegawai
                        </label>

                        <input
                            type="text"
                            id="edit_employee_name"
                            name="employee_name"
                            class="form-control employee-form-input <?= isset($errors['employee_name']) ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan nama pegawai"
                            value="<?= esc($employeeName) ?>">

                        <?php if (isset($errors['employee_name'])): ?>
                            <div class="invalid-feedback">
                                <?= esc($errors['employee_name']) ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="col-12 col-md-6">

                        <label
                            for="edit_phone"
                            class="form-label employee-form-label">
                            Nomor HP
                        </label>

                        <input
                            type="tel"
                            id="edit_phone"
                            name="phone"
                            class="form-control employee-form-input"
                            placeholder="Contoh: 081234567890"
                            value="<?= esc($phone) ?>"
                            inputmode="numeric"
                            autocomplete="tel"
                            maxlength="15">

                        <div
                            id="editPhoneError"
                            class="invalid-feedback">
                        </div>

                        <?php if (isset($errors['phone'])): ?>
                            <div class="invalid-feedback">
                                <?= esc($errors['phone']) ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="col-12 col-md-6">

                        <label
                            for="edit_department_id"
                            class="form-label employee-form-label">
                            Bagian/Departemen
                        </label>

                        <select
                            id="edit_department_id"
                            name="department_id"
                            class="form-select employee-form-input <?= isset($errors['department_id']) ? 'is-invalid' : '' ?>">

                            <option value="">
                                Pilih Bagian/Departemen
                            </option>

                            <?php foreach ($departments as $department): ?>

                                <option
                                    value="<?= esc($department['id']) ?>"
                                    <?= (string) $departmentId === (string) $department['id'] ? 'selected' : '' ?>>
                                    <?= esc($department['name']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                        <?php if (isset($errors['department_id'])): ?>
                            <div class="invalid-feedback">
                                <?= esc($errors['department_id']) ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="col-12">

                        <label
                            for="edit_active"
                            class="form-label employee-form-label">
                            Status
                        </label>

                        <select
                            id="edit_active"
                            name="active"
                            class="form-select employee-form-input <?= isset($errors['active']) ? 'is-invalid' : '' ?>">

                            <option
                                value="1"
                                <?= (string) $active === '1' ? 'selected' : '' ?>>
                                Aktif
                            </option>

                            <option
                                value="0"
                                <?= (string) $active === '0' ? 'selected' : '' ?>>
                                Nonaktif
                            </option>

                        </select>

                        <?php if (isset($errors['active'])): ?>
                            <div class="invalid-feedback">
                                <?= esc($errors['active']) ?>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>

            </div>

            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelEditPegawai">
                    Batal
                </button>

                <button
                    type="submit"
                    class="btn employee-button-primary rounded-pill">
                    <i class="bi bi-check-lg me-1"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>