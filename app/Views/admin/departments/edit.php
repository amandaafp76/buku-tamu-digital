<?php
$errors = $errors ?? session()->getFlashdata('errors') ?? [];
$error  = $error ?? session()->getFlashdata('error');

$formData = $formData ?? [];
?>

<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i class="bi bi-building-gear"></i>
            </div>

            <div class="employee-modal-heading">

                <h1 class="employee-modal-title">
                    Edit Bagian/Departemen
                </h1>

                <p class="employee-modal-description">
                    Perbarui data bagian atau departemen.
                </p>

            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeEditDepartemen"
                aria-label="Tutup">

                <i class="bi bi-x-lg"></i>

            </button>

        </div>

        <?php if ($error): ?>

            <div class="employee-form-alert">

                <i class="bi bi-exclamation-circle"></i>

                <span>
                    <?= esc($error) ?>
                </span>

            </div>

        <?php endif; ?>

        <form
            action="<?= base_url('admin/bukutamu-departemen/edit/' . $department['id']) ?>"
            method="post"
            novalidate>

            <?= csrf_field() ?>

            <div class="employee-modal-body">

                <div class="row g-4">

                    <div class="col-12">

                        <label
                            for="department_name_edit"
                            class="form-label employee-form-label">

                            Nama Bagian/Departemen

                        </label>

                        <input
                            type="text"
                            id="department_name_edit"
                            name="name"
                            class="form-control employee-form-input <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan nama bagian/departemen"
                            value="<?= esc(
                                        old(
                                            'name',
                                            $formData['name'] ?? $department['name']
                                        )
                                    ) ?>"
                            minlength="3"
                            maxlength="50"
                            autocomplete="organization">

                        <div
                            id="departmentNameEditError"
                            class="invalid-feedback">

                            <?php if (isset($errors['name'])): ?>
                                <?= esc($errors['name']) ?>
                            <?php endif; ?>

                        </div>

                    </div>

                    <div class="col-12">

                        <label
                            for="department_active_edit"
                            class="form-label employee-form-label">

                            Status

                        </label>

                        <select
                            id="department_active_edit"
                            name="active"
                            class="form-select employee-form-input <?= isset($errors['active']) ? 'is-invalid' : '' ?>">

                            <option
                                value="1"
                                <?= (string) old(
                                    'active',
                                    $formData['active'] ?? $department['active']
                                ) === '1' ? 'selected' : '' ?>>

                                Aktif

                            </option>

                            <option
                                value="0"
                                <?= (string) old(
                                    'active',
                                    $formData['active'] ?? $department['active']
                                ) === '0' ? 'selected' : '' ?>>

                                Nonaktif

                            </option>

                        </select>

                        <div
                            id="departmentActiveEditError"
                            class="invalid-feedback">

                            <?php if (isset($errors['active'])): ?>
                                <?= esc($errors['active']) ?>
                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>

            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelEditDepartemen">

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