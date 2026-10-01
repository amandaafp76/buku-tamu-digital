<?php
$errors = $errors ?? session()->getFlashdata('errors') ?? [];
$guest = $guest ?? [];
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
        Tujuan Kunjungan - Buku Tamu
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

        <span class="register-orb register-orb-one"></span>
        <span class="register-orb register-orb-two"></span>
        <span class="register-orb register-orb-three"></span>

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
                        Registrasi Kunjungan
                    </h1>

                </div>

            </header>


            <nav
                class="register-stepper"
                aria-label="Tahapan registrasi">

                <div class="register-step">
                    <div class="register-step-number">1</div>

                    <div class="register-step-content">
                        <div class="register-step-label">
                            Identitas
                        </div>
                    </div>
                </div>


                <div class="register-step active">
                    <div class="register-step-number">2</div>

                    <div class="register-step-content">
                        <div class="register-step-label">
                            Tujuan
                        </div>
                    </div>
                </div>


                <div class="register-step">
                    <div class="register-step-number">3</div>

                    <div class="register-step-content">
                        <div class="register-step-label">
                            Foto
                        </div>
                    </div>
                </div>


                <div class="register-step">
                    <div class="register-step-number">4</div>

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

                        <i class="bi bi-clipboard-check"></i>

                    </div>

                    <h2 class="register-card-title">
                        Tujuan Kunjungan
                    </h2>

                    <p class="register-card-description">
                        Informasikan tujuan kedatangan Anda agar kunjungan
                        dapat diproses dengan tepat.
                    </p>

                </div>

                <form
                    class="register-form"
                    id="guestPurposeForm"
                    action="<?= site_url('bukutamu-kiosk/tujuan') ?>"
                    method="post"
                    data-employees-url="<?= site_url('bukutamu-kiosk/pegawai') ?>"
                    data-old-employee-id="<?= esc(old('employee_id', '')) ?>">

                    <?= csrf_field() ?>


                    <div class="register-field">

                        <label
                            for="purpose_id"
                            class="register-label">

                            Tujuan Kunjungan
                            <span class="register-required">
                                *
                            </span>

                        </label>

                        <select
                            id="purpose_id"
                            name="purpose_id"
                            class="register-select <?= isset($errors['purpose_id']) ? 'is-invalid' : '' ?>">

                            <option
                                value=""
                                <?= old('purpose_id') ? '' : 'selected' ?>
                                disabled>

                                Pilih tujuan kunjungan

                            </option>

                            <?php foreach ($purposes as $purpose): ?>

                                <option
                                    value="<?= esc($purpose['id']) ?>"
                                    <?= (string) old('purpose_id') === (string) $purpose['id'] ? 'selected' : '' ?>>

                                    <?= esc($purpose['purpose_name']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                        <p
                            class="register-field-error <?= isset($errors['purpose_id']) ? 'is-visible' : '' ?>"
                            id="purposeIdError">
                            <?= isset($errors['purpose_id']) ? esc($errors['purpose_id']) : '' ?>
                        </p>

                    </div>


                    <div class="register-form-row">

                        <div class="register-field">

                            <label
                                for="department_id"
                                class="register-label">

                                Bagian / Departemen
                                <span class="register-required">
                                    *
                                </span>

                            </label>

                            <select
                                id="department_id"
                                name="department_id"
                                class="register-select <?= isset($errors['department_id']) ? 'is-invalid' : '' ?>">

                                <option
                                    value=""
                                    <?= old('department_id') ? '' : 'selected' ?>
                                    disabled>

                                    Pilih bagian / departemen

                                </option>

                                <?php foreach ($departments as $department): ?>

                                    <option
                                        value="<?= esc($department['id']) ?>"
                                        <?= (string) old('department_id') === (string) $department['id'] ? 'selected' : '' ?>>

                                        <?= esc($department['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                            <p
                                class="register-field-error <?= isset($errors['department_id']) ? 'is-visible' : '' ?>"
                                id="departmentIdError">
                                <?= isset($errors['department_id']) ? esc($errors['department_id']) : '' ?>
                            </p>

                        </div>


                        <div class="register-field">

                            <label
                                for="employee_id"
                                class="register-label">

                                Pegawai yang Dituju
                                <span class="register-required">
                                    *
                                </span>

                            </label>

                            <select
                                id="employee_id"
                                name="employee_id"
                                class="register-select <?= isset($errors['employee_id']) ? 'is-invalid' : '' ?>"
                                disabled>

                                <option
                                    value=""
                                    selected
                                    disabled>

                                    Pilih bagian terlebih dahulu

                                </option>

                            </select>

                            <p
                                class="register-field-error <?= isset($errors['employee_id']) ? 'is-visible' : '' ?>"
                                id="employeeIdError">
                                <?= isset($errors['employee_id']) ? esc($errors['employee_id']) : '' ?>
                            </p>

                        </div>

                    </div>


                    <div class="register-field">

                        <label
                            for="keperluan"
                            class="register-label">

                            Detail Keperluan

                            <span class="register-required">
                                *
                            </span>

                        </label>

                        <textarea
                            id="keperluan"
                            name="keperluan"
                            class="register-input register-textarea <?= isset($errors['keperluan']) ? 'is-invalid' : '' ?>"
                            placeholder="Jelaskan secara singkat keperluan kunjungan Anda"
                            rows="4"><?= esc(old('keperluan', '')) ?></textarea>

                        <p
                            class="register-field-error <?= isset($errors['keperluan']) ? 'is-visible' : '' ?>"
                            id="keperluanError">
                            <?= isset($errors['keperluan']) ? esc($errors['keperluan']) : '' ?>
                        </p>

                    </div>


                    <p class="register-help">
                        Tanda <span class="register-required">*</span>
                        menunjukkan data yang wajib diisi.
                    </p>


                    <div class="register-actions">

                        <a
                            href="<?= site_url('bukutamu-kiosk/registrasi') ?>"
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
                            class="register-primary">

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

                </form>

            </section>

        </div>

    </main>

    <script
        src="<?= base_url('assets/js/purpose.js') ?>">
    </script>

</body>

</html>