<?php
$errors = $errors ?? session()->getFlashdata('errors') ?? [];
?>

<?= $this->extend('layouts/kiosk') ?>

<?= $this->section('content') ?>

<main class="register-page">

    <div class="register-shell">

        <header class="register-header">

            <div class="register-title-area">

                <div class="register-eyebrow">
                    Buku Tamu Digital
                </div>

                <h1 class="register-title">
                    Registrasi Kunjungan
                </h1>

            </div>

            <a
                href="<?= site_url('bukutamu-kiosk/foto') ?>"
                class="register-back">

                <i
                    class="bi bi-arrow-left"
                    aria-hidden="true">
                </i>

                <span>
                    Kembali
                </span>

            </a>

        </header>


        <nav
            class="register-stepper"
            aria-label="Tahapan registrasi">

            <div class="register-step completed">

                <div class="register-step-number">
                    <i class="bi bi-check" aria-hidden="true"></i>
                </div>

                <div class="register-step-label">
                    Identitas
                </div>

            </div>

            <div class="register-step-line active" aria-hidden="true"></div>

            <div class="register-step completed">

                <div class="register-step-number">
                    <i class="bi bi-check" aria-hidden="true"></i>
                </div>

                <div class="register-step-label">
                    Tujuan
                </div>

            </div>

            <div class="register-step-line active" aria-hidden="true"></div>

            <div class="register-step completed">

                <div class="register-step-number">
                    <i class="bi bi-check" aria-hidden="true"></i>
                </div>

                <div class="register-step-label">
                    Foto
                </div>

            </div>

            <div class="register-step-line active" aria-hidden="true"></div>

            <div class="register-step active">

                <div class="register-step-number">
                    4
                </div>

                <div class="register-step-label">
                    Persetujuan
                </div>

            </div>

        </nav>


        <section class="register-card">

            <div class="register-card-header">

                <div
                    class="register-card-icon"
                    aria-hidden="true">

                    <i class="bi bi-shield-check"></i>

                </div>

                <h2 class="register-card-title">
                    Persetujuan Kunjungan
                </h2>

                <p class="register-card-description">
                    Periksa kembali data Anda, berikan tanda tangan,
                    lalu setujui penggunaan data untuk proses kunjungan.
                </p>

            </div>


            <form
                class="register-form"
                id="consentForm"
                action="<?= site_url('bukutamu-kiosk/persetujuan') ?>"
                method="post"
                data-offline-guard>

                <?= csrf_field() ?>

                <div class="register-field-card">
                    <div class="consent-section">

                        <div class="consent-section-title">
                            <i
                                class="bi bi-person-vcard"
                                aria-hidden="true">
                            </i>

                            <span>
                                Data Pengunjung
                            </span>
                        </div>
                    </div>


                    <div class="consent-summary">

                        <div class="consent-summary-item">

                            <span class="consent-summary-label">
                                Nama Lengkap
                            </span>

                            <strong>
                                <?= esc($guest['nama_lengkap'] ?? '-') ?>
                            </strong>

                        </div>


                        <div class="consent-summary-item">

                            <span class="consent-summary-label">
                                Nomor HP
                            </span>

                            <strong>
                                <?= esc($guest['nomor_hp'] ?? '-') ?>
                            </strong>

                        </div>


                        <div class="consent-summary-item">

                            <span class="consent-summary-label">
                                Asal Instansi / Perusahaan
                            </span>

                            <strong>
                                <?= esc($guest['asal_instansi'] ?? '-') ?>
                            </strong>

                        </div>


                        <div class="consent-summary-item">

                            <span class="consent-summary-label">
                                Bagian / Departemen
                            </span>

                            <strong>
                                <?= esc($department['name'] ?? '-') ?>
                            </strong>

                        </div>


                        <div class="consent-summary-item">

                            <span class="consent-summary-label">
                                Pegawai yang Dituju
                            </span>

                            <strong>
                                <?= esc($employee['employee_name'] ?? '-') ?>
                            </strong>

                        </div>

                    </div>

                </div>

                <div class="register-field-card">
                    <div class="consent-section">

                        <div class="consent-section-title">

                            <i
                                class="bi bi-pen"
                                aria-hidden="true">
                            </i>

                            <span>
                                Tanda Tangan Digital
                            </span>

                            <span class="register-required">
                                *
                            </span>

                        </div>


                        <p class="register-help">
                            Silakan tanda tangan pada area berikut.
                        </p>


                        <div class="signature-wrapper">

                            <canvas
                                id="signatureCanvas"
                                class="signature-canvas">
                            </canvas>

                        </div>


                        <input
                            type="hidden"
                            name="signature"
                            id="signatureInput">


                        <div
                            id="signatureError"
                            class="register-field-error"
                            aria-live="polite">
                        </div>


                        <button
                            type="button"
                            class="register-secondary"
                            id="clearSignatureButton">

                            <i
                                class="bi bi-eraser"
                                aria-hidden="true">
                            </i>

                            <span>
                                Hapus Tanda Tangan
                            </span>

                        </button>

                    </div>
                </div>

                <div class="register-field-card">
                    <div class="consent-section">

                        <div class="consent-section-title">

                            <i
                                class="bi bi-shield-lock"
                                aria-hidden="true">
                            </i>

                            <span>
                                Persetujuan Penggunaan Data
                            </span>

                            <span class="register-required">
                                *
                            </span>

                        </div>


                        <div class="consent-box">

                            <p>
                                Saya menyatakan bahwa data yang saya
                                berikan adalah benar dan saya menyetujui
                                penggunaan data kunjungan, foto, serta
                                tanda tangan untuk keperluan administrasi
                                dan pencatatan kunjungan.
                            </p>

                        </div>


                        <label class="consent-checkbox">

                            <input
                                type="checkbox"
                                name="consent"
                                id="consent"
                                value="1">

                            <span>
                                Saya menyetujui penggunaan data tersebut.
                            </span>

                        </label>


                        <div
                            id="consentError"
                            class="register-field-error"
                            aria-live="polite">
                        </div>

                    </div>


                    <p class="register-help register-help--block">
                        Tanda <span class="register-required">*</span>
                        menunjukkan data yang wajib diisi.
                    </p>


                    <div class="register-actions">

                        <a
                            href="<?= site_url('bukutamu-kiosk/foto') ?>"
                            class="register-secondary">

                            <i
                                class="bi bi-arrow-left"
                                aria-hidden="true">
                            </i>

                            <span>
                                Kembali
                            </span>

                        </a>


                        <button
                            type="submit"
                            class="register-primary"
                            id="submitConsentButton">

                            <span>
                                Kirim Registrasi
                            </span>

                            <span
                                class="register-primary-icon"
                                aria-hidden="true">

                                <i class="bi bi-check2"></i>

                            </span>

                        </button>

                    </div>

                </div>

            </form>

        </section>

    </div>

</main>

<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script
    src="<?= base_url('assets/js/consent.js') ?>">
</script>

<?= $this->endSection() ?>