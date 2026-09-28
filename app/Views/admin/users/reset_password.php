<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i class="bi bi-key"></i>
            </div>

            <div class="employee-modal-heading">

                <h1 class="employee-modal-title">
                    Reset Password
                </h1>

                <p class="employee-modal-description">
                    Atur ulang password akun pengguna.
                </p>

            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeResetPassword"
                aria-label="Tutup">

                <i class="bi bi-x-lg"></i>

            </button>

        </div>


        <?php
        $errors = $errors ?? [];
        $error  = $error ?? null;
        $formData = $formData ?? [];
        ?>


        <?php if (! empty($errors) || $error): ?>

            <div class="employee-form-alert">

                <i class="bi bi-exclamation-circle"></i>

                <div>

                    <?php if ($error): ?>

                        <?= esc($error) ?>

                    <?php else: ?>

                        Periksa kembali data yang dimasukkan.

                    <?php endif; ?>

                </div>

            </div>

        <?php endif; ?>


        <form
            id="formResetPassword"
            action="<?= base_url('admin/bukutamu-pengguna/reset-password/' . $user['id']) ?>"
            method="post">

            <?= csrf_field() ?>


            <div class="employee-modal-body">

                <div class="employee-delete-summary mb-4">

                    <div class="employee-delete-summary-item">

                        <div class="employee-delete-summary-icon">

                            <i class="bi bi-person"></i>

                        </div>

                        <div class="employee-delete-summary-content">

                            <span class="employee-delete-summary-label">
                                Username
                            </span>

                            <strong class="employee-delete-summary-value">
                                <?= esc($user['username']) ?>
                            </strong>

                        </div>

                    </div>


                    <div class="employee-delete-summary-item">

                        <div class="employee-delete-summary-icon">

                            <i class="bi bi-shield-check"></i>

                        </div>

                        <div class="employee-delete-summary-content">

                            <span class="employee-delete-summary-label">
                                Role
                            </span>

                            <span class="employee-delete-summary-value">

                                <?= $user['role'] === 'administrator'
                                    ? 'Administrator'
                                    : 'Petugas' ?>

                            </span>

                        </div>

                    </div>

                </div>


                <div class="mb-3">

                    <label
                        for="password_reset"
                        class="employee-form-label">

                        Password Baru

                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password_reset"
                        class="form-control employee-form-input <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                        placeholder="Masukkan password baru"
                        autocomplete="new-password">

                    <?php if (isset($errors['password'])): ?>

                        <div class="invalid-feedback">
                            <?= esc($errors['password']) ?>
                        </div>

                    <?php endif; ?>

                </div>


                <div>

                    <label
                        for="password_confirm_reset"
                        class="employee-form-label">

                        Konfirmasi Password Baru

                    </label>

                    <input
                        type="password"
                        name="password_confirm"
                        id="password_confirm_reset"
                        class="form-control employee-form-input <?= isset($errors['password_confirm']) ? 'is-invalid' : '' ?>"
                        placeholder="Ulangi password baru"
                        autocomplete="new-password">

                    <?php if (isset($errors['password_confirm'])): ?>

                        <div class="invalid-feedback">
                            <?= esc($errors['password_confirm']) ?>
                        </div>

                    <?php endif; ?>

                </div>


                <div class="employee-delete-warning mt-4">

                    <i class="bi bi-info-circle"></i>

                    <span>
                        Password lama akan digantikan dengan password baru
                        setelah proses reset berhasil.
                    </span>

                </div>

            </div>


            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelResetPassword">

                    Batal

                </button>


                <button
                    type="submit"
                    class="btn employee-button-primary rounded-pill">

                    <i class="bi bi-key me-1"></i>

                    Reset Password

                </button>

            </div>

        </form>

    </div>

</div>