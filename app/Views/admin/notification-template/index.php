<?= $this->extend('layouts/dashboard.php') ?>

<?= $this->section('pageCss') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/setting.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid px-0">

    <div
        class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">

        <div>

            <h1 class="h4 mb-1 fw-semibold setting-page-title">
                Template Pesan
            </h1>

            <p class="mb-0 text-muted small">
                Kelola template pesan notifikasi untuk tamu dan pegawai.
            </p>

        </div>


        <button
            type="button"
            class="btn glass-button-primary rounded-pill px-4"
            id="openNotificationTemplateCreate"
            data-modal-url="<?= base_url(
                                'admin/bukutamu-template-pesan/tambah'
                            ) ?>">

            <i
                class="bi bi-plus-circle me-2"
                aria-hidden="true"></i>

            Tambah Template

        </button>

    </div>

    <?php if (session()->getFlashdata('success')): ?>

        <div
            class="alert employee-success-alert glass-card mb-4"
            role="alert">

            <i
                class="bi bi-check-circle-fill"
                aria-hidden="true"></i>

            <span>
                <?= esc(
                    session()->getFlashdata('success')
                ) ?>
            </span>

        </div>

    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>

        <div
            class="alert employee-error-alert glass-card mb-4"
            role="alert">

            <i
                class="bi bi-exclamation-circle-fill"
                aria-hidden="true"></i>

            <span>
                <?= esc(
                    session()->getFlashdata('error')
                ) ?>
            </span>

        </div>

    <?php endif; ?>


    <?php if (empty($templates)): ?>

        <div
            class="glass-card p-4 p-lg-5 text-center">

            <div class="mb-3">

                <i
                    class="bi bi-chat-square-text"
                    style="
                        font-size: 2rem;
                        color: var(--color-primary);
                    "
                    aria-hidden="true">
                </i>

            </div>


            <h2 class="h6 fw-semibold mb-2">
                Belum ada template pesan
            </h2>


            <p class="text-muted small mb-4">
                Belum terdapat template pesan notifikasi
                yang tersimpan.
            </p>


            <button
                type="button"
                class="btn glass-button-primary rounded-pill px-4"
                id="openNotificationTemplateCreateEmpty"
                data-modal-url="<?= base_url(
                                    'admin/bukutamu-template-pesan/tambah'
                                ) ?>">

                <i
                    class="bi bi-plus-circle me-2"
                    aria-hidden="true"></i>

                Tambah Template

            </button>

        </div>


    <?php else: ?>

        <div class="row g-4">

            <?php foreach ($templates as $template): ?>

                <?php
                $recipientLabel = match ($template['recipient_type']) {
                    'guest' => 'Tamu',
                    'employee' => 'Pegawai',
                    default => $template['recipient_type'],
                };

                $notificationLabel = match ($template['notification_type']) {
                    'registration_success'
                    => 'Registrasi Berhasil',

                    'check_in'
                    => 'Check-in',

                    'visit_warning'
                    => 'Peringatan Kunjungan',

                    'check_out'
                    => 'Check-out',

                    default
                    => $template['notification_type'],
                };
                ?>


                <div class="col-12 col-xl-6">

                    <div
                        class="glass-card h-100 p-4">


                        <div
                            class="d-flex align-items-start justify-content-between gap-3 mb-4">

                            <div
                                class="d-flex align-items-center gap-2">

                                <div
                                    class="employee-modal-icon">

                                    <i
                                        class="bi bi-chat-square-text"
                                        aria-hidden="true">
                                    </i>

                                </div>


                                <div>

                                    <h2
                                        class="h6 fw-semibold mb-1">

                                        <?= esc(
                                            $notificationLabel
                                        ) ?>

                                    </h2>


                                    <p
                                        class="text-muted small mb-0">

                                        <?= esc(
                                            $recipientLabel
                                        ) ?>

                                    </p>

                                </div>

                            </div>


                            <span
                                class="setting-status-badge <?= (int) $template['active'] === 1
                                                                ? 'is-active'
                                                                : 'is-inactive' ?>">

                                <i
                                    class="bi <?= (int) $template['active'] === 1
                                                    ? 'bi-check-circle-fill'
                                                    : 'bi-x-circle-fill' ?>"
                                    aria-hidden="true">
                                </i>

                                <?= (int) $template['active'] === 1
                                    ? 'Aktif'
                                    : 'Nonaktif' ?>

                            </span>

                        </div>


                        <div class="row g-3 mb-4">


                            <div class="col-12">

                                <div
                                    class="setting-info-item">

                                    <span
                                        class="setting-info-label">

                                        Penerima

                                    </span>


                                    <span
                                        class="setting-info-value">

                                        <?= esc(
                                            $recipientLabel
                                        ) ?>

                                    </span>

                                </div>

                            </div>


                            <div class="col-12">

                                <div
                                    class="setting-info-item">

                                    <span
                                        class="setting-info-label">

                                        Jenis Notifikasi

                                    </span>


                                    <span
                                        class="setting-info-value">

                                        <?= esc(
                                            $notificationLabel
                                        ) ?>

                                    </span>

                                </div>

                            </div>


                            <div class="col-12">

                                <div
                                    class="setting-info-item">

                                    <span
                                        class="setting-info-label">

                                        Isi Pesan

                                    </span>


                                    <div
                                        class="setting-info-value text-break">

                                        <?= nl2br(
                                            esc(
                                                $template['template_message']
                                            )
                                        ) ?>

                                    </div>

                                </div>

                            </div>


                        </div>


                        <div
                            class="d-flex justify-content-end">

                            <button
                                type="button"
                                class="btn glass-button-primary rounded-pill px-4"
                                data-notification-template-edit
                                data-modal-url="<?= base_url(
                                                    'admin/bukutamu-template-pesan/edit/'
                                                        . $template['id']
                                                ) ?>">

                                <i
                                    class="bi bi-pencil-square me-2"
                                    aria-hidden="true">
                                </i>

                                Edit Template

                            </button>

                        </div>


                    </div>

                </div>


            <?php endforeach; ?>

        </div>

    <?php endif; ?>


</div>


<div
    class="employee-modal-overlay"
    id="notificationTemplateModalOverlay"
    aria-hidden="true">

    <div
        class="employee-modal-overlay-backdrop">
    </div>


    <div
        class="employee-modal-container"
        id="notificationTemplateModalContainer">
    </div>

</div>


<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script src="<?= base_url('assets/js/notification-template.js') ?>"></script>

<?= $this->endSection() ?>