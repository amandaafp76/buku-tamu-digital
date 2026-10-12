<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'Dashboard') ?></title>

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/bootstrap.min.css') ?>">

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/app.css') ?>">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/components.css') ?>">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/sidebar.css') ?>">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/navbar.css') ?>">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/admin-components.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/pwa.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/bottom-nav.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/install-prompt.css') ?>">

    <?php
    $primaryColor = $settings['primary_color'] ?? '#9A3F3F';

    log_message(
        'debug',
        'GLOBAL PRIMARY COLOR: ' . $primaryColor
    );
    ?>

    <style>
        :root {
            --color-primary: <?= esc($primaryColor) ?>;
        }
    </style>

    <link rel="manifest" href="<?= base_url('manifest.json') ?>">
    <meta name="theme-color" content="<?= esc($primaryColor) ?>">
    <link rel="apple-touch-icon" href="<?= base_url('assets/icons/icon-192x192.png') ?>">

    <?= $this->include('components/splash-links') ?>

    <?= $this->renderSection('pageCss') ?>
</head>

<body>

    <?= $this->include('components/sidebar') ?>

    <div class="dashboard-shell">

        <?= $this->include('components/navbar') ?>

        <main class="dashboard-content">
            <?= $this->renderSection('content') ?>
        </main>

    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script src="<?= base_url('assets/js/sidebar.js') ?>"></script>

    <script src="<?= base_url('assets/js/pwa.js') ?>"></script>

    <script src="<?= base_url('assets/js/form-guard.js') ?>"></script>

    <script src="<?= base_url('assets/js/install-prompt.js') ?>"></script>

    <?= $this->include('components/confirmation-modal') ?>

    <script src="<?= base_url('assets/js/confirmation-modal.js') ?>"></script>

    <?= $this->include('components/bottom-nav') ?>

    <?= $this->renderSection('pageJs') ?>

</body>

</html>