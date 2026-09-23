<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Buku Tamu Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/components.css') ?>">
    <script src="<?= base_url('assets/js/app.js') ?>"></script>

    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;

            padding: 24px;

            background:
                radial-gradient(circle at 15% 15%,
                    rgba(193, 133, 109, 0.42),
                    transparent 34%),
                radial-gradient(circle at 85% 80%,
                    rgba(230, 207, 169, 0.75),
                    transparent 38%),
                linear-gradient(135deg,
                    #FBF9D1 0%,
                    #F7EBCF 48%,
                    #E6CFA9 100%);
        }

        body::before,
        body::after {
            content: "";
            position: fixed;

            border-radius: 50%;

            pointer-events: none;

            filter: blur(8px);
        }

        body::before {
            width: 220px;
            height: 220px;

            top: -70px;
            right: -50px;

            background: rgba(154, 63, 63, 0.18);
        }

        body::after {
            width: 180px;
            height: 180px;

            bottom: -60px;
            left: -40px;

            background: rgba(193, 133, 109, 0.22);
        }

        .login-wrapper {
            width: 100%;
            max-width: 430px;

            position: relative;
            z-index: 1;
        }

        .login-card {
            width: 100%;
            padding: 38px 34px;
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-icon {
            width: 64px;
            height: 64px;

            margin: 0 auto 18px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 20px;

            background: rgba(154, 63, 63, 0.92);

            color: #fff;

            font-size: 26px;
            font-weight: 700;

            box-shadow:
                0 12px 24px rgba(154, 63, 63, 0.22),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        .brand h1 {
            font-size: 25px;
            font-weight: 700;

            letter-spacing: -0.5px;

            color: var(--color-primary);
        }

        .brand p {
            margin-top: 7px;

            font-size: 13px;
            line-height: 1.6;

            color: var(--text-secondary);
        }

        .alert {
            margin-bottom: 20px;

            padding: 13px 15px;

            border: 1px solid rgba(154, 63, 63, 0.16);
            border-radius: 16px;

            background: rgba(154, 63, 63, 0.09);

            color: var(--color-primary);

            font-size: 13px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

            font-size: 13px;
            font-weight: 600;

            color: var(--text-primary);
        }

        .input-wrapper {
            position: relative;
        }

        .login-input {
            height: 52px;
        }

        .password-wrapper {
            position: relative;
        }

        .password-input {
            padding-right: 58px;
        }

        .password-toggle {
            position: absolute;

            top: 50%;
            right: 8px;

            width: 44px;
            height: 44px;

            display: flex;
            align-items: center;
            justify-content: center;

            transform: translateY(-50%);

            border: 0;
            border-radius: 14px;

            background: transparent;

            color: var(--text-secondary);

            cursor: pointer;

            transition:
                background 0.2s ease,
                color 0.2s ease;
        }

        .password-toggle:hover {
            background: rgba(154, 63, 63, 0.08);
            color: var(--color-primary);
        }

        .password-toggle:focus-visible {
            outline: none;
            box-shadow:
                0 0 0 3px rgba(154, 63, 63, 0.12);
        }

        .password-toggle-icon {
            font-size: 20px;
            line-height: 1;
        }

        .login-button {
            width: 100%;

            min-height: 52px;

            margin-top: 8px;

            border: 0;
            border-radius: var(--radius-button);

            background: var(--color-primary);

            color: #fff;

            font-family: inherit;
            font-size: 14px;
            font-weight: 600;

            cursor: pointer;

            box-shadow:
                0 12px 24px rgba(154, 63, 63, 0.22),
                inset 0 1px 0 rgba(255, 255, 255, 0.18);

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        .login-button:hover {
            background: #873737;

            transform: translateY(-1px);

            box-shadow:
                0 15px 28px rgba(154, 63, 63, 0.26);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .footer-text {
            margin-top: 24px;

            text-align: center;

            font-size: 11px;
            line-height: 1.6;

            color: var(--text-secondary);
        }

        .field-error {
            display: block;

            margin-top: 7px;

            color: var(--color-primary);

            font-size: 12px;
            line-height: 1.5;
        }

        @media (max-width: 480px) {
            body {
                padding: 16px;
            }

            .login-card {
                padding: 30px 22px;

                border-radius: 24px;
            }

            .brand h1 {
                font-size: 22px;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                transition: none !important;
            }
        }
    </style>
</head>

<body>

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
                <div class="alert">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('login') ?>" method="post">

                <?= csrf_field() ?>

                <div class="form-group">

                    <label for="username">
                        Email
                    </label>

                    <div class="input-wrapper">
                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="<?= old('username') ?>"
                            placeholder="Masukkan email"
                            autocomplete="username"
                            class="glass-input login-input">
                    </div>

                    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

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
                            class="glass-input login-input password-input">

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

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

</body>

</html>