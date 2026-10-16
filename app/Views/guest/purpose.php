<?php
$errors = $errors ?? session()->getFlashdata('errors') ?? [];
$guest = $guest ?? [];
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

            <div class="register-step-line" aria-hidden="true"></div>

            <div class="register-step active">
                <div class="register-step-number">2</div>
                <div class="register-step-label">
                    Tujuan
                </div>
            </div>

            <div class="register-step-line" aria-hidden="true"></div>

            <div class="register-step">
                <div class="register-step-number">3</div>
                <div class="register-step-label">
                    Foto
                </div>
            </div>

            <div class="register-step-line" aria-hidden="true"></div>

            <div class="register-step">
                <div class="register-step-number">4</div>
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
                data-old-employee-id="<?= esc(old('employee_id', $guest['employee_id'] ?? '')) ?>"
                data-offline-guard>

                <?= csrf_field() ?>


                <div class="register-field-card">

                    <label
                        for="purpose_id"
                        class="register-label">

                        Tujuan Kunjungan
                        <span class="register-required">
                            *
                        </span>

                    </label>

                    <div class="register-input-wrapper">

                        <i
                            class="register-input-icon bi bi-bullseye"
                            aria-hidden="true">
                        </i>

                        <select
                            id="purpose_id"
                            name="purpose_id"
                            class="register-select <?= isset($errors['purpose_id']) ? 'is-invalid' : '' ?>">

                            <option
                                value=""
                                <?= old('purpose_id', $guest['purpose_id'] ?? '') ? '' : 'selected' ?>
                                disabled>

                                Pilih tujuan kunjungan

                            </option>

                            <?php foreach ($purposes as $purpose): ?>

                                <option
                                    value="<?= esc($purpose['id']) ?>"
                                    <?= (string) old('purpose_id', $guest['purpose_id'] ?? '') === (string) $purpose['id'] ? 'selected' : '' ?>>

                                    <?= esc($purpose['purpose_name']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <p
                        class="register-field-error <?= isset($errors['purpose_id']) ? 'is-visible' : '' ?>"
                        id="purposeIdError">
                        <?= isset($errors['purpose_id']) ? esc($errors['purpose_id']) : '' ?>
                    </p>

                </div>


                <div class="register-form-row">

                    <div class="register-field-card">

                        <label
                            for="department_id"
                            class="register-label">

                            Bagian / Departemen
                            <span class="register-required">
                                *
                            </span>

                        </label>

                        <div class="register-input-wrapper">

                            <i
                                class="register-input-icon bi bi-diagram-3"
                                aria-hidden="true">
                            </i>

                            <select
                                id="department_id"
                                name="department_id"
                                class="register-select <?= isset($errors['department_id']) ? 'is-invalid' : '' ?>">

                                <option
                                    value=""
                                    <?= old('department_id', $guest['department_id'] ?? '') ? '' : 'selected' ?>
                                    disabled>

                                    Pilih bagian / departemen

                                </option>

                                <?php foreach ($departments as $department): ?>

                                    <option
                                        value="<?= esc($department['id']) ?>"
                                        <?= (string) old('department_id', $guest['department_id'] ?? '') === (string) $department['id'] ? 'selected' : '' ?>>

                                        <?= esc($department['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <p
                            class="register-field-error <?= isset($errors['department_id']) ? 'is-visible' : '' ?>"
                            id="departmentIdError">
                            <?= isset($errors['department_id']) ? esc($errors['department_id']) : '' ?>
                        </p>

                    </div>


                    <div class="register-field-card">

                        <label
                            for="employee_id"
                            class="register-label">

                            Pegawai yang Dituju
                            <span class="register-required">
                                *
                            </span>

                        </label>

                        <div class="register-input-wrapper">

                            <i
                                class="register-input-icon bi bi-person-badge"
                                aria-hidden="true">
                            </i>

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

                        </div>

                        <p
                            class="register-field-error <?= isset($errors['employee_id']) ? 'is-visible' : '' ?>"
                            id="employeeIdError">
                            <?= isset($errors['employee_id']) ? esc($errors['employee_id']) : '' ?>
                        </p>

                    </div>

                </div>

                <p class="register-help register-help--block">
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

<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script
    src="<?= base_url('assets/js/purpose.js') ?>">
</script>

<?= $this->endSection() ?>