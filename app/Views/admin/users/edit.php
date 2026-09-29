<?php

$errors = $errors ?? [];
$error = $error ?? null;
$formData = $formData ?? [];

?>

<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i class="bi bi-person-gear"></i>
            </div>

            <div class="employee-modal-heading">

                <h1 class="employee-modal-title">
                    Edit Pengguna
                </h1>

                <p class="employee-modal-description">
                    Perbarui data akun pengguna.
                </p>

            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeEditPengguna"
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
            id="formEditPengguna"
            action="<?= base_url('admin/bukutamu-pengguna/edit/' . $user['id']) ?>"
            method="post"
            novalidate>

            <?= csrf_field() ?>

            <div class="employee-modal-body">

                <div class="row g-4">

                    <div class="col-12">

                        <label
                            for="username_edit"
                            class="form-label employee-form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            id="username_edit"
                            name="username"
                            class="form-control employee-form-input <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan alamat email"
                            value="<?= esc(old('username', $formData['username'] ?? $user['username'])) ?>"
                            maxlength="100"
                            autocomplete="username"
                            inputmode="email">

                        <?php if (isset($errors['username'])): ?>

                            <div class="invalid-feedback d-block">
                                <?= esc($errors['username']) ?>
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="col-12 col-md-6">

                        <label
                            for="user_role_edit"
                            class="form-label employee-form-label">

                            Role

                        </label>

                        <select
                            id="user_role_edit"
                            name="role"
                            class="form-select employee-form-input <?= isset($errors['role']) ? 'is-invalid' : '' ?>">

                            <option
                                value="administrator"
                                <?= old('role', $formData['role'] ?? $user['role']) === 'administrator' ? 'selected' : '' ?>>

                                Administrator

                            </option>

                            <option
                                value="petugas"
                                <?= old('role', $formData['role'] ?? $user['role']) === 'petugas' ? 'selected' : '' ?>>

                                Petugas

                            </option>

                        </select>

                        <?php if (isset($errors['role'])): ?>

                            <div class="invalid-feedback d-block">
                                <?= esc($errors['role']) ?>
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="col-12 col-md-6">

                        <label
                            for="user_active_edit"
                            class="form-label employee-form-label">

                            Status

                        </label>

                        <select
                            id="user_active_edit"
                            name="active"
                            class="form-select employee-form-input <?= isset($errors['active']) ? 'is-invalid' : '' ?>">

                            <option
                                value="1"><?= (string) old(
                                                'active',
                                                $formData['active'] ?? $user['active']
                                            ) === '1' ? 'selected' : '' ?>

                                Aktif

                            </option>

                            <option
                                value="0"
                                <?= (string) old(
                                    'active',
                                    $formData['active'] ?? $user['active']
                                ) === '0' ? 'selected' : '' ?>>

                                Nonaktif

                            </option>

                        </select>

                        <?php if (isset($errors['active'])): ?>

                            <div class="invalid-feedback d-block">
                                <?= esc($errors['active']) ?>
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="col-12">

                        <div class="employee-modal-section-title">
                            Ubah Password
                        </div>

                        <p class="employee-modal-description mb-0">
                            Kosongkan password jika tidak ingin mengubah
                            password pengguna.
                        </p>

                    </div>

                    <div class="col-12 col-md-6">

                        <label
                            for="password_edit"
                            class="form-label employee-form-label">

                            Password Baru

                        </label>

                        <input
                            type="password"
                            id="password_edit"
                            name="password"
                            class="form-control employee-form-input <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                            placeholder="Kosongkan jika tidak diubah"
                            maxlength="72"
                            autocomplete="new-password">

                        <?php if (isset($errors['password'])): ?>

                            <div class="invalid-feedback d-block">
                                <?= esc($errors['password']) ?>
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="col-12 col-md-6">

                        <label
                            for="password_confirm_edit"
                            class="form-label employee-form-label">

                            Konfirmasi Password Baru

                        </label>

                        <input
                            type="password"
                            id="password_confirm_edit"
                            name="password_confirm"
                            class="form-control employee-form-input <?= isset($errors['password_confirm']) ? 'is-invalid' : '' ?>"
                            placeholder="Ulangi password baru"
                            maxlength="72"
                            autocomplete="new-password">

                        <?php if (isset($errors['password_confirm'])): ?>

                            <div class="invalid-feedback d-block">
                                <?= esc($errors['password_confirm']) ?>
                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelEditPengguna">

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