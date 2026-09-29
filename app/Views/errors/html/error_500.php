<?php
$userRole = session()->get('role');
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        500 - Terjadi Kesalahan
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
                    class="bi bi-exclamation-triangle"
                    aria-hidden="true">
                </i>

            </div>

            <h1 class="error-code">
                500
            </h1>

            <h2 class="error-title">
                Terjadi Kesalahan
            </h2>

            <p class="error-description">
                Terjadi kesalahan pada server.
                Silakan coba lagi beberapa saat kemudian.
            </p>

            <?php if (session()->get('logged_in')): ?>

                <?php if ($userRole === 'administrator'): ?>

                    <a
                        href="<?= site_url('admin/bukutamu-dashboard') ?>"
                        class="error-action">

                        <i
                            class="bi bi-house"
                            aria-hidden="true">
                        </i>

                        Kembali ke Dashboard

                    </a>

                <?php elseif ($userRole === 'petugas'): ?>

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