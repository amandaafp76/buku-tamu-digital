<?php
$errors = $errors ?? session()->getFlashdata('errors') ?? [];

$requirePhoto = $requirePhoto ?? 1;
$photoSize    = $photoSize ?? 500;
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <meta
        name="theme-color"
        content="#FBF9D1">

    <title>
        Foto Pengunjung - Buku Tamu
    </title>

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/bootstrap-icons.css') ?>">

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/kiosk.css') ?>">

</head>

<body>

    <div
        class="register-background"
        aria-hidden="true">

        <span
            class="register-orb register-orb-one">
        </span>

        <span
            class="register-orb register-orb-two">
        </span>

        <span
            class="register-orb register-orb-three">
        </span>

    </div>


    <main class="register-page">

        <div class="register-shell">

            <header class="register-header">

                <a
                    href="<?= site_url('bukutamu-kiosk') ?>"
                    class="register-back">

                    <i
                        class="bi bi-arrow-left"
                        aria-hidden="true">
                    </i>

                    <span>
                        Beranda
                    </span>

                </a>

                <div class="register-title-area">

                    <div class="register-eyebrow">
                        Buku Tamu Digital
                    </div>

                    <h1 class="register-title">
                        Foto Pengunjung
                    </h1>

                </div>

            </header>


            <nav
                class="register-stepper"
                aria-label="Tahapan registrasi">

                <div class="register-step completed">

                    <div class="register-step-number">
                        <i class="bi bi-check"></i>
                    </div>

                    <div class="register-step-content">

                        <div class="register-step-label">
                            Identitas
                        </div>

                    </div>

                </div>


                <div class="register-step completed">

                    <div class="register-step-number">
                        <i class="bi bi-check"></i>
                    </div>

                    <div class="register-step-content">

                        <div class="register-step-label">
                            Tujuan
                        </div>

                    </div>

                </div>


                <div class="register-step active">

                    <div class="register-step-number">
                        3
                    </div>

                    <div class="register-step-content">

                        <div class="register-step-label">
                            Foto
                        </div>

                    </div>

                </div>


                <div class="register-step">

                    <div class="register-step-number">
                        4
                    </div>

                    <div class="register-step-content">

                        <div class="register-step-label">
                            Persetujuan
                        </div>

                    </div>

                </div>

            </nav>


            <section class="register-card">

                <div class="register-card-header">

                    <div
                        class="register-card-icon"
                        aria-hidden="true">

                        <i class="bi bi-camera"></i>

                    </div>

                    <h2 class="register-card-title">
                        Ambil Foto Anda
                    </h2>

                    <p class="register-card-description">
                        <?php if ($requirePhoto === 1): ?>
                            Foto wajib diambil sebelum melanjutkan.
                            Anda dapat menggunakan kamera perangkat.
                        <?php else: ?>
                            Foto bersifat opsional.
                            Anda dapat mengambil foto menggunakan kamera
                            atau langsung melanjutkan tanpa foto.
                        <?php endif; ?>
                    </p>

                </div>


                <div
                    id="photoError"
                    class="register-alert photo-alert"
                    hidden>

                    <div
                        class="register-alert-icon"
                        aria-hidden="true">

                        <i class="bi bi-exclamation-circle"></i>

                    </div>

                    <div>

                        <strong>
                            Foto belum dapat diproses
                        </strong>

                        <div id="photoErrorMessage"></div>

                    </div>

                </div>


                <form
                    class="register-form"
                    id="photoForm"
                    action="<?= site_url('bukutamu-kiosk/foto') ?>"
                    method="post"
                    enctype="multipart/form-data">

                    <?= csrf_field() ?>


                    <div class="photo-camera-area">

                        <div
                            class="photo-preview-container"
                            id="photoPreviewContainer">

                            <div
                                class="photo-placeholder"
                                id="photoPlaceholder">

                                <i
                                    class="bi bi-camera"
                                    aria-hidden="true">
                                </i>

                                <span>
                                    Kamera belum dibuka
                                </span>

                            </div>

                            <video
                                id="cameraPreview"
                                class="photo-camera-preview"
                                autoplay
                                playsinline
                                muted
                                hidden>
                            </video>

                        </div>


                        <canvas
                            id="photoCanvas"
                            hidden>
                        </canvas>


                        <div
                            class="photo-status"
                            id="cameraStatus">

                            <i
                                class="bi bi-info-circle"
                                aria-hidden="true">
                            </i>

                            <span>
                                Kamera belum digunakan.
                            </span>

                        </div>


                        <div class="photo-actions">

                            <button
                                type="button"
                                class="register-primary photo-button"
                                id="openCameraButton">

                                <span>
                                    Buka Kamera
                                </span>

                                <span
                                    class="register-primary-icon"
                                    aria-hidden="true">

                                    <i class="bi bi-camera"></i>

                                </span>

                            </button>


                            <button
                                type="button"
                                class="register-secondary photo-button"
                                id="capturePhotoButton"
                                hidden>

                                <i
                                    class="bi bi-camera-fill"
                                    aria-hidden="true">
                                </i>

                                <span>
                                    Ambil Foto
                                </span>

                            </button>

                        </div>

                    </div>


                    <div
                        class="photo-upload-divider"
                        id="photoUploadDivider"
                        hidden>

                        <span>
                            atau pilih foto dari perangkat
                        </span>

                    </div>


                    <div
                        class="photo-upload-area"
                        id="photoUploadArea"
                        hidden>

                        <div class="photo-upload-title">
                            Kamera tidak dapat digunakan
                        </div>

                        <p class="photo-upload-description">
                            Anda dapat memilih foto dari perangkat sebagai alternatif.
                        </p>

                        <label
                            for="photoInput"
                            class="photo-upload-label">

                            <i
                                class="bi bi-upload"
                                aria-hidden="true">
                            </i>

                            <span>
                                Pilih Foto dari Perangkat
                            </span>

                        </label>

                        <input
                            type="file"
                            id="photoInput"
                            name="photo"
                            accept="image/jpeg,image/png,image/webp"
                            hidden>

                    </div>


                    <div class="register-actions">

                        <a
                            href="<?= site_url('bukutamu-kiosk/tujuan') ?>"
                            class="register-secondary">

                            <i
                                class="bi bi-arrow-left"
                                aria-hidden="true">
                            </i>

                            <span>
                                Kembali
                            </span>

                        </a>


                        <?php if ($requirePhoto === 0): ?>

                            <button
                                type="submit"
                                class="register-primary"
                                id="photoContinueButton">

                                <span>
                                    Lanjut Tanpa Foto
                                </span>

                                <span
                                    class="register-primary-icon"
                                    aria-hidden="true">

                                    <i class="bi bi-arrow-right"></i>

                                </span>

                            </button>

                        <?php endif; ?>

                    </div>

                </form>

            </section>

        </div>

    </main>

    <div
        class="photo-preview-modal"
        id="photoPreviewModal"
        hidden
        aria-hidden="true">

        <div
            class="photo-preview-modal-backdrop"
            data-photo-modal-close>
        </div>


        <div
            class="photo-preview-modal-dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="photoPreviewModalTitle">

            <div class="photo-preview-modal-header">

                <div>

                    <div class="photo-preview-modal-eyebrow">
                        Buku Tamu Digital
                    </div>

                    <h2
                        class="photo-preview-modal-title"
                        id="photoPreviewModalTitle">

                        Foto Anda

                    </h2>

                    <p class="photo-preview-modal-subtitle">
                        Periksa foto Anda sebelum melanjutkan.
                    </p>

                </div>

            </div>


            <div class="photo-preview-modal-body">

                <div class="photo-preview-result">

                    <img
                        id="photoPreview"
                        class="photo-result-preview"
                        alt="Preview foto pengunjung">

                </div>

                <p class="photo-preview-modal-description">

                    Pastikan wajah dan foto Anda terlihat jelas
                    sebelum melanjutkan.

                </p>

            </div>


            <div class="photo-preview-modal-actions">

                <button
                    type="button"
                    class="register-secondary photo-button"
                    id="retakePhotoButton">

                    <i
                        class="bi bi-arrow-repeat"
                        aria-hidden="true">
                    </i>

                    <span>
                        Foto Ulang
                    </span>

                </button>


                <button
                    type="button"
                    class="register-primary photo-button"
                    id="modalPhotoContinueButton">

                    <span>
                        Lanjut
                    </span>

                    <span
                        class="register-primary-icon"
                        aria-hidden="true">

                        <i class="bi bi-arrow-right"></i>

                    </span>

                </button>

            </div>

        </div>

    </div>

    <script>
        window.photoConfig = {
            requirePhoto: <?= $requirePhoto === 1 ? 'true' : 'false' ?>,
            maxFileSize: <?= (int) $photoSize ?> * 1024
        };
    </script>

    <script
        src="<?= base_url('assets/js/photo.js') ?>">
    </script>

</body>

</html>