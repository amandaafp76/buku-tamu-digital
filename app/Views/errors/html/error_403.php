<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        403 - Akses Ditolak
    </title>

    <link
        href="<?= base_url('assets/css/bootstrap.min.css') ?>"
        rel="stylesheet">

    <link
        href="<?= base_url('assets/css/bootstrap-icons.css') ?>"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link
        href="<?= base_url('assets/css/error-pages.css') ?>"
        rel="stylesheet">

</head>

<body>

    <main class="error-page">

        <section class="error-card">

            <div class="error-icon">

                <i
                    class="bi bi-shield-lock"
                    aria-hidden="true">
                </i>

            </div>

            <h1 class="error-code">
                403
            </h1>

            <h2 class="error-title">
                Akses Ditolak
            </h2>

            <p class="error-description">
                Anda tidak memiliki hak akses untuk membuka halaman ini.
            </p>

            <?php if (session()->get('logged_in')): ?>

                <?php if (session()->get('role') === 'administrator'): ?>

                    <a
                        href="<?= site_url('admin/bukutamu-dashboard') ?>"
                        class="error-action">

                        <i
                            class="bi bi-house"
                            aria-hidden="true">
                        </i>

                        Kembali ke Dashboard

                    </a>

                <?php elseif (session()->get('role') === 'petugas'): ?>

                    <a
                        href="<?= site_url('petugas/bukutamu-dashboard') ?>"
                        class="error-action">

                        <i
                            class="bi bi-house"
                            aria-hidden="true">
                        </i>

                        Kembali ke Dashboard

                    </a>

                <?php else: ?>

                    <a
                        href="<?= site_url('bukutamu-keluar') ?>"
                        class="error-action">

                        <i
                            class="bi bi-box-arrow-right"
                            aria-hidden="true">
                        </i>

                        Keluar

                    </a>

                <?php endif; ?>

            <?php else: ?>

                <a
                    href="<?= site_url('bukutamu-masuk') ?>"
                    class="error-action">

                    <i
                        class="bi bi-box-arrow-in-right"
                        aria-hidden="true">
                    </i>

                    Masuk

                </a>

            <?php endif; ?>

        </section>

    </main>

</body>

</html>