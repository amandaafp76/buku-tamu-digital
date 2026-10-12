<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <title><?= esc($title ?? 'Buku Tamu - Kiosk') ?></title>

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

    <?php
    $primaryColor = $settings['primary_color'] ?? '#9A3F3F';
    ?>

    <meta name="theme-color" content="<?= esc($primaryColor) ?>">

    <link rel="manifest" href="<?= base_url('manifest.json') ?>">
    <link rel="apple-touch-icon" href="<?= base_url('assets/icons/icon-192x192.png') ?>">

    <?= $this->include('components/splash-links') ?>

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/kiosk.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pwa.css') ?>">

    <style>
        :root {
            --color-primary: <?= esc($primaryColor) ?>;
        }
    </style>

    <?= $this->renderSection('pageCss') ?>
</head>

<body>

    <div class="register-background" aria-hidden="true">
        <span class="register-orb register-orb-one"></span>
        <span class="register-orb register-orb-two"></span>
        <span class="register-orb register-orb-three"></span>
    </div>

    <?= $this->renderSection('content') ?>

    <script src="<?= base_url('assets/js/pwa.js') ?>"></script>

    <script src="<?= base_url('assets/js/form-guard.js') ?>"></script>

    <?= $this->renderSection('pageJs') ?>
</body>

</html>