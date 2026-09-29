<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>

<?php
$errors = session()->getFlashdata('errors') ?? [];
?>

<main class="login-wrapper container-fluid d-flex align-items-center justify-content-center">

    <section class="login-card glass-card">

        <div class="brand">

            <div class="brand-icon">
                BT
            </div>

            <h1>Buku Tamu Digital</h1>

            <p>
                Silakan masuk untuk melanjutkan
            </p>

        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="login-alert">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('bukutamu-masuk') ?>" method="post" novalidate>

            <?= csrf_field() ?>

            <div class="form-group">

                <label for="username">
                    Email
                </label>

                <div class="input-wrapper">
                    <input
                        type="email"
                        id="username"
                        name="username"
                        value="<?= old('username') ?>"
                        placeholder="Masukkan alamat email"
                        autocomplete="username"
                        inputmode="email"
                        maxlength="100"
                        class="glass-input login-input <?= ! empty($errors['username'] ?? null) ? 'is-invalid' : '' ?>">
                </div>

                <?php if (! empty($errors['username'])): ?>
                    <small class="field-error">
                        <?= esc($errors['username']) ?>
                    </small>
                <?php endif; ?>

            </div>

            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <div class="input-wrapper password-wrapper">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        maxlength="72"
                        class="glass-input login-input password-input <?= ! empty($errors['password'] ?? null) ? 'is-invalid' : '' ?>">

                    <button
                        type="button"
                        class="password-toggle"
                        id="passwordToggle"
                        aria-label="Tampilkan password"
                        aria-pressed="false">
                        <i
                            class="bi bi-eye-slash password-toggle-icon"
                            aria-hidden="true">
                        </i>
                    </button>

                </div>

                <?php if (! empty($errors['password'])): ?>
                    <small class="field-error">
                        <?= esc($errors['password']) ?>
                    </small>
                <?php endif; ?>

            </div>

            <button
                type="submit"
                class="login-button">
                Masuk
            </button>

        </form>

        <p class="footer-text">
            Sistem Buku Tamu Digital
        </p>

    </section>

</main>

<?= $this->endSection() ?>


<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/auth.js') ?>"></script>

<?= $this->endSection() ?>