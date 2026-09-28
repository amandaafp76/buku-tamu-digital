<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i
                    class="bi bi-sliders2"
                    aria-hidden="true"></i>
            </div>

            <div class="employee-modal-heading">

                <h2 class="employee-modal-title">
                    Edit Konfigurasi Sistem
                </h2>

                <p class="employee-modal-description">
                    Atur tampilan dan validasi yang digunakan
                    dalam sistem buku tamu.
                </p>

            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeSettingEdit"
                aria-label="Tutup modal">
                <i
                    class="bi bi-x-lg"
                    aria-hidden="true"></i>
            </button>

        </div>


        <?php if (isset($validation)): ?>

            <div
                class="employee-form-alert"
                role="alert">
                <i
                    class="bi bi-exclamation-circle-fill"
                    aria-hidden="true"></i>

                <div>
                    <?= $validation->listErrors() ?>
                </div>
            </div>

        <?php endif; ?>


        <form
            id="settingEditForm"
            action="<?= base_url('admin/bukutamu-konfigurasi/update') ?>"
            method="post"
            novalidate>

            <?= csrf_field() ?>


            <div class="employee-modal-body">


                <div class="setting-form-section">

                    <div class="setting-form-section-heading">

                        <div class="setting-form-section-icon">
                            <i
                                class="bi bi-palette"
                                aria-hidden="true"></i>
                        </div>

                        <div>
                            <h3 class="setting-form-section-title">
                                Tampilan
                            </h3>

                            <p class="setting-form-section-description">
                                Tentukan warna utama yang digunakan
                                pada antarmuka sistem.
                            </p>
                        </div>

                    </div>


                    <div class="setting-color-picker">

                        <div class="setting-color-picker-preview">
                            <span
                                id="settingColorPreview"
                                style="
                                    background-color:
                                    <?= esc(
                                        old(
                                            'primary_color',
                                            $setting['primary_color']
                                                ?? '#9A3F3F'
                                        )
                                    );
                                    ?>
                                "></span>
                        </div>


                        <div class="setting-color-picker-input">

                            <label
                                for="settingPrimaryColor"
                                class="employee-form-label">
                                Warna Utama
                            </label>

                            <div class="setting-color-input-group">

                                <input
                                    type="color"
                                    id="settingPrimaryColorPicker"
                                    value="<?= esc(
                                                old(
                                                    'primary_color',
                                                    $setting['primary_color']
                                                        ?? '#9A3F3F'
                                                )
                                            ) ?>"
                                    aria-label="Pilih warna utama">

                                <input
                                    type="text"
                                    class="form-control employee-form-input"
                                    id="settingPrimaryColor"
                                    name="primary_color"
                                    value="<?= esc(
                                                old(
                                                    'primary_color',
                                                    $setting['primary_color']
                                                        ?? '#9A3F3F'
                                                )
                                            ) ?>"
                                    maxlength="7">

                            </div>

                            <div
                                id="settingPrimaryColorError"
                                class="invalid-feedback">
                            </div>

                        </div>

                    </div>

                </div>



                <div class="setting-form-section">

                    <div class="setting-form-section-heading">

                        <div class="setting-form-section-icon">
                            <i
                                class="bi bi-shield-check"
                                aria-hidden="true"></i>
                        </div>

                        <div>
                            <h3 class="setting-form-section-title">
                                Validasi Kunjungan
                            </h3>

                            <p class="setting-form-section-description">
                                Tentukan persyaratan yang harus
                                dipenuhi tamu saat berkunjung.
                            </p>
                        </div>

                    </div>


                    <div class="setting-toggle-list">


                        <div class="setting-toggle-item">

                            <div class="setting-toggle-content">

                                <span class="setting-toggle-title">
                                    Wajib Foto
                                </span>

                                <span class="setting-toggle-description">
                                    Tamu harus mengambil foto
                                    sebelum kunjungan dapat dilanjutkan.
                                </span>

                            </div>

                            <label
                                class="setting-switch"
                                for="settingRequirePhoto">

                                <input
                                    type="hidden"
                                    name="require_photo"
                                    value="0">

                                <input
                                    type="checkbox"
                                    id="settingRequirePhoto"
                                    name="require_photo"
                                    value="1"
                                    <?= (
                                        (int) old(
                                            'require_photo',
                                            $setting['require_photo']
                                                ?? 1
                                        ) === 1
                                    ) ? 'checked' : '' ?>>

                                <span
                                    class="setting-switch-slider"
                                    aria-hidden="true"></span>

                            </label>

                        </div>


                        <div class="setting-toggle-item">

                            <div class="setting-toggle-content">

                                <span class="setting-toggle-title">
                                    Wajib Tanda Tangan
                                </span>

                                <span class="setting-toggle-description">
                                    Tamu harus memberikan tanda tangan
                                    sebelum kunjungan dapat dilanjutkan.
                                </span>

                            </div>

                            <label
                                class="setting-switch"
                                for="settingRequireSignature">

                                <input
                                    type="hidden"
                                    name="require_signature"
                                    value="0">

                                <input
                                    type="checkbox"
                                    id="settingRequireSignature"
                                    name="require_signature"
                                    value="1"
                                    <?= (
                                        (int) old(
                                            'require_signature',
                                            $setting['require_signature']
                                                ?? 1
                                        ) === 1
                                    ) ? 'checked' : '' ?>>

                                <span
                                    class="setting-switch-slider"
                                    aria-hidden="true"></span>

                            </label>

                        </div>

                    </div>

                </div>


                <div class="setting-form-section">

                    <div class="setting-form-section-heading">

                        <div class="setting-form-section-icon">
                            <i
                                class="bi bi-camera"
                                aria-hidden="true"></i>
                        </div>

                        <div>
                            <h3 class="setting-form-section-title">
                                Pengaturan Foto
                            </h3>

                            <p class="setting-form-section-description">
                                Atur batas ukuran file foto yang
                                dapat digunakan pada sistem.
                            </p>
                        </div>

                    </div>


                    <div>

                        <label
                            for="settingPhotoSize"
                            class="employee-form-label">
                            Ukuran Foto
                        </label>

                        <div>

                            <div class="setting-number-input">

                                <input
                                    type="number"
                                    class="form-control employee-form-input"
                                    id="settingPhotoSize"
                                    name="photo_size"
                                    value="<?= esc(
                                                old(
                                                    'photo_size',
                                                    $setting['photo_size'] ?? 0
                                                )
                                            ) ?>"
                                    min="0"
                                    step="1">

                                <span class="setting-number-unit">
                                    KB
                                </span>

                            </div>

                            <div
                                id="settingPhotoSizeError"
                                class="invalid-feedback">
                            </div>

                        </div>

                        <div class="form-text mt-2">
                            Isi 0 jika ukuran foto tidak dibatasi.
                        </div>

                    </div>

                </div>



                <div class="setting-form-section">

                    <div class="setting-form-section-heading">

                        <div class="setting-form-section-icon">
                            <i
                                class="bi bi-clock-history"
                                aria-hidden="true"></i>
                        </div>

                        <div>
                            <h3 class="setting-form-section-title">
                                Peringatan Kunjungan
                            </h3>

                            <p class="setting-form-section-description">
                                Tentukan batas waktu untuk
                                memberikan peringatan kunjungan.
                            </p>
                        </div>

                    </div>


                    <div>

                        <label
                            for="settingWarningLimit"
                            class="employee-form-label">
                            Batas Peringatan
                        </label>

                        <div>

                            <div class="setting-number-input">

                                <input
                                    type="number"
                                    class="form-control employee-form-input"
                                    id="settingWarningLimit"
                                    name="warning_limit"
                                    value="<?= esc(
                                                old(
                                                    'warning_limit',
                                                    $setting['warning_limit'] ?? 0
                                                )
                                            ) ?>"
                                    min="0"
                                    step="1">

                                <span class="setting-number-unit">
                                    Menit
                                </span>

                            </div>

                            <div
                                id="settingWarningLimitError"
                                class="invalid-feedback">
                            </div>

                        </div>

                        <div class="form-text mt-2">
                            Isi 0 untuk menonaktifkan peringatan.
                        </div>

                    </div>

                </div>

            </div>


            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelSettingEdit">
                    Batal
                </button>

                <button
                    type="submit"
                    class="btn employee-button-primary rounded-pill">
                    <i
                        class="bi bi-check2-circle me-2"
                        aria-hidden="true"></i>

                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>