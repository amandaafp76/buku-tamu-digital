<?php

$errors = $errors ?? [];
$error = $error ?? null;
$formData = $formData ?? [];

?>

<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i class="bi bi-person-plus"></i>
            </div>

            <div class="employee-modal-heading">

                <h1 class="employee-modal-title">
                    Tambah Pengguna
                </h1>

                <p class="employee-modal-description">
                    Tambahkan akun pengguna baru ke dalam sistem.
                </p>

            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeTambahPengguna"
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
            id="formTambahPengguna"
            action="<?= base_url('admin/bukutamu-pengguna/tambah') ?>"
            method="post"
            novalidate>

            <?= csrf_field() ?>

            <div class="employee-modal-body">

                <div class="row g-4">

                    <div class="col-12">

                        <label
                            for="username"
                            class="form-label employee-form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            id="username"
                            name="username"
                            class="form-control employee-form-input <?= isset($errors['username']) ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan alamat email"
                            value="<?= esc(old('username', $formData['username'] ?? '')) ?>"
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
                            for="password"
                            class="form-label employee-form-label">

                            Password

                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control employee-form-input <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan password"
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
                            for="password_confirm"
                            class="form-label employee-form-label">

                            Konfirmasi Password

                        </label>

                        <input
                            type="password"
                            id="password_confirm"
                            name="password_confirm"
                            class="form-control employee-form-input <?= isset($errors['password_confirm']) ? 'is-invalid' : '' ?>"
                            placeholder="Ulangi password"
                            maxlength="72"
                            autocomplete="new-password">

                        <?php if (isset($errors['password_confirm'])): ?>

                            <div class="invalid-feedback d-block">
                                <?= esc($errors['password_confirm']) ?>
                            </div>

                        <?php endif; ?>

                    </div>

                    <div class="col-12 col-md-6">

                        <label
                            for="user_role"
                            class="form-label employee-form-label">

                            Role

                        </label>

                        <select
                            id="user_role"
                            name="role"
                            class="form-select employee-form-input <?= isset($errors['role']) ? 'is-invalid' : '' ?>">

                            <option value="">
                                Pilih Role
                            </option>

                            <option
                                value="administrator"
                                <?= old('role', $formData['role'] ?? '') === 'administrator' ? 'selected' : '' ?>>

                                Administrator

                            </option>

                            <option
                                value="petugas"
                                <?= old('role', $formData['role'] ?? '') === 'petugas' ? 'selected' : '' ?>>

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
                            for="user_active"
                            class="form-label employee-form-label">

                            Status

                        </label>

                        <select
                            id="user_active"
                            name="active"
                            class="form-select employee-form-input <?= isset($errors['active']) ? 'is-invalid' : '' ?>">

                            <option
                                value="1"
                                <?= old('active', $formData['active'] ?? '1') === '1' ? 'selected' : '' ?>>

                                Aktif

                            </option>

                            <option
                                value="0"
                                <?= old('active', $formData['active'] ?? '1') === '0' ? 'selected' : '' ?>>

                                Nonaktif

                            </option>

                        </select>

                        <?php if (isset($errors['active'])): ?>

                            <div class="invalid-feedback d-block">
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
                    id="cancelTambahPengguna">

                    Batal

                </button>

                <button
                    type="submit"
                    class="btn employee-button-primary rounded-pill">

                    <i class="bi bi-check-lg me-1"></i>

                    Simpan Pengguna

                </button>

            </div>

        </form>

    </div>

</div>