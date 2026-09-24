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
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?= $this->renderSection('pageJs') ?>

</body>

</html>