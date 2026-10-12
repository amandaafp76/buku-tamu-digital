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

            <div class="register-step active">

                <div class="register-step-number">
                    1
                </div>

                <div class="register-step-content">

                    <div class="register-step-label">
                        Identitas
                    </div>

                </div>

            </div>


            <div class="register-step">

                <div class="register-step-number">
                    2
                </div>

                <div class="register-step-content">

                    <div class="register-step-label">
                        Tujuan
                    </div>

                </div>

            </div>


            <div class="register-step">

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

                    <i class="bi bi-person-vcard"></i>

                </div>

                <h2 class="register-card-title">
                    Kenali Anda Terlebih Dahulu
                </h2>

                <p class="register-card-description">
                    Silakan isi data identitas Anda dengan benar
                    untuk melanjutkan proses registrasi kunjungan.
                </p>

            </div>


            <form
                class="register-form"
                id="guestRegisterForm"
                action="<?= site_url('bukutamu-kiosk/registrasi') ?>"
                method="post"
                data-offline-guard>

                <?= csrf_field() ?>

                <div class="register-form-row">

                    <div class="register-field-card">

                        <label
                            for="nama_lengkap"
                            class="register-label">

                            Nama Lengkap
                            <span class="register-required">
                                *
                            </span>

                        </label>

                        <div class="register-input-wrapper">

                            <i
                                class="register-input-icon bi bi-person"
                                aria-hidden="true">
                            </i>

                            <input
                                type="text"
                                id="nama_lengkap"
                                name="nama_lengkap"
                                class="register-input <?= isset($errors['nama_lengkap']) ? 'is-invalid' : '' ?>"
                                placeholder="Masukkan nama lengkap"
                                autocomplete="name"
                                value="<?= esc($guest['nama_lengkap'] ?? '') ?>">

                        </div>

                        <p
                            class="register-field-error <?= isset($errors['nama_lengkap']) ? 'is-visible' : '' ?>"
                            id="namaLengkapError">
                            <?= isset($errors['nama_lengkap']) ? esc($errors['nama_lengkap']) : '' ?>
                        </p>

                    </div>


                    <div class="register-field-card">

                        <label
                            for="nomor_hp"
                            class="register-label">

                            Nomor HP
                            <span class="register-required">
                                *
                            </span>

                        </label>

                        <div class="register-input-wrapper">

                            <i
                                class="register-input-icon bi bi-telephone"
                                aria-hidden="true">
                            </i>

                            <input
                                type="tel"
                                id="nomor_hp"
                                name="nomor_hp"
                                class="register-input <?= isset($errors['nomor_hp']) ? 'is-invalid' : '' ?>"
                                placeholder="Contoh: 081234567890"
                                autocomplete="tel"
                                inputmode="tel"
                                value="<?= esc($guest['nomor_hp'] ?? '') ?>">

                        </div>

                        <p
                            class="register-field-error <?= isset($errors['nomor_hp']) ? 'is-visible' : '' ?>"
                            id="nomorHpError">
                            <?= isset($errors['nomor_hp']) ? esc($errors['nomor_hp']) : '' ?>
                        </p>

                    </div>

                </div>

                <div class="register-field-card">

                    <label
                        for="alamat"
                        class="register-label">

                        Alamat
                        <span class="register-required">
                            *
                        </span>

                    </label>

                    <div class="register-input-wrapper register-input-wrapper--textarea">

                        <i
                            class="register-input-icon bi bi-geo-alt"
                            aria-hidden="true">
                        </i>

                        <textarea
                            id="alamat"
                            name="alamat"
                            class="register-input <?= isset($errors['alamat']) ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan alamat tempat tinggal"
                            rows="3"
                            autocomplete="street-address"><?= esc($guest['alamat'] ?? '') ?></textarea>

                    </div>

                    <p
                        class="register-field-error <?= isset($errors['alamat']) ? 'is-visible' : '' ?>"
                        id="alamatError">
                        <?= isset($errors['alamat']) ? esc($errors['alamat']) : '' ?>
                    </p>

                </div>

                <div class="register-field-card">

                    <label
                        for="asal_instansi"
                        class="register-label">

                        Asal Instansi / Perusahaan
                        <span class="register-required">
                            *
                        </span>

                    </label>

                    <div class="register-input-wrapper">

                        <i
                            class="register-input-icon bi bi-building"
                            aria-hidden="true">
                        </i>

                        <input
                            type="text"
                            id="asal_instansi"
                            name="asal_instansi"
                            class="register-input <?= isset($errors['asal_instansi']) ? 'is-invalid' : '' ?>"
                            placeholder="Contoh: PT Contoh Indonesia"
                            autocomplete="organization"
                            value="<?= esc($guest['asal_instansi'] ?? '') ?>">

                    </div>

                    <p
                        class="register-field-error <?= isset($errors['asal_instansi']) ? 'is-visible' : '' ?>"
                        id="asalInstansiError">
                        <?= isset($errors['asal_instansi']) ? esc($errors['asal_instansi']) : '' ?>
                    </p>

                </div>

                <div class="register-field-card">

                    <label
                        for="group_size"
                        class="register-label">

                        Jumlah Rombongan
                        <span class="register-required">
                            *
                        </span>

                    </label>

                    <div class="register-input-wrapper">

                        <i
                            class="register-input-icon bi bi-building"
                            aria-hidden="true">
                        </i>

                        <input
                            type="number"
                            id="group_size"
                            name="group_size"
                            class="register-input <?= isset($errors['group_size']) ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan jumlah orang"
                            min="1"
                            max="999"
                            inputmode="numeric"
                            value="<?= esc($guest['group_size'] ?? '') ?>">

                    </div>

                    <p
                        class="register-field-error <?= isset($errors['group_size']) ? 'is-visible' : '' ?>"
                        id="groupSizeError">
                        <?= isset($errors['group_size']) ? esc($errors['group_size']) : '' ?>
                    </p>

                    <p class="register-help">
                        Masukkan jumlah seluruh orang yang datang dalam rombongan.
                    </p>


                </div>

                <div class="register-form-row">

                    <div class="register-field-card">

                        <label
                            for="jenis_identitas"
                            class="register-label">

                            Jenis Identitas
                            <span class="register-required">
                                *
                            </span>

                        </label>

                        <div class="register-input-wrapper">

                            <i
                                class="register-input-icon bi bi-card-text"
                                aria-hidden="true">
                            </i>

                            <select
                                id="jenis_identitas"
                                name="jenis_identitas"
                                class="register-select <?= isset($errors['jenis_identitas']) ? 'is-invalid' : '' ?>">

                                <option
                                    value=""
                                    <?= empty($guest['jenis_identitas']) ? 'selected' : '' ?>
                                    disabled>

                                    Pilih jenis identitas

                                </option>

                                <option
                                    value="KTP"
                                    <?= ($guest['jenis_identitas'] ?? '') === 'KTP' ? 'selected' : '' ?>>

                                    KTP

                                </option>

                                <option
                                    value="SIM"
                                    <?= ($guest['jenis_identitas'] ?? '') === 'SIM' ? 'selected' : '' ?>>

                                    SIM

                                </option>

                                <option
                                    value="PASPOR"
                                    <?= ($guest['jenis_identitas'] ?? '') === 'PASPOR' ? 'selected' : '' ?>>

                                    Paspor

                                </option>

                                <option
                                    value="LAINNYA"
                                    <?= ($guest['jenis_identitas'] ?? '') === 'LAINNYA' ? 'selected' : '' ?>>

                                    Lainnya

                                </option>

                            </select>

                        </div>

                        <p
                            class="register-field-error <?= isset($errors['jenis_identitas']) ? 'is-visible' : '' ?>"
                            id="jenisIdentitasError">

                            <?= isset($errors['jenis_identitas']) ? esc($errors['jenis_identitas']) : '' ?>

                        </p>

                    </div>


                    <div class="register-field-card">

                        <label
                            for="nomor_identitas"
                            class="register-label">

                            Nomor Identitas
                            <span class="register-required">
                                *
                            </span>

                        </label>

                        <div class="register-input-wrapper">

                            <i
                                class="register-input-icon bi bi-credit-card-2-front"
                                aria-hidden="true">
                            </i>

                            <input
                                type="text"
                                id="nomor_identitas"
                                name="nomor_identitas"
                                class="register-input <?= isset($errors['nomor_identitas']) ? 'is-invalid' : '' ?>"
                                placeholder="Masukkan nomor identitas"
                                autocomplete="off"
                                value="<?= esc($guest['nomor_identitas'] ?? '') ?>">

                        </div>

                        <p
                            class="register-field-error <?= isset($errors['nomor_identitas']) ? 'is-visible' : '' ?>"
                            id="nomorIdentitasError">

                            <?= isset($errors['nomor_identitas']) ? esc($errors['nomor_identitas']) : '' ?>

                        </p>

                    </div>

                </div>


                <p class="register-help register-help--block">
                    Tanda <span class="register-required">*</span>
                    menunjukkan data yang wajib diisi.
                </p>

                <div class="register-actions">

                    <a
                        href="<?= site_url('bukutamu-kiosk') ?>"
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
    src="<?= base_url('assets/js/register.js') ?>">
</script>

<?= $this->endSection() ?>