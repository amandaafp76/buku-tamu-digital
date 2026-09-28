<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'Login - Buku Tamu Digital') ?></title>

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
        href="<?= base_url('assets/css/login.css') ?>">

    <?= $this->renderSection('pageCss') ?>

</head>

<body>

    <?= $this->renderSection('content') ?>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

    <?= $this->renderSection('pageJs') ?>

</body>

</html>