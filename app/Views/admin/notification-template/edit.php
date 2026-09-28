<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i
                    class="bi bi-chat-square-text"
                    aria-hidden="true"></i>
            </div>

            <div class="employee-modal-heading">

                <h2 class="employee-modal-title">

                    <?= $template
                        ? 'Edit Template Pesan'
                        : 'Tambah Template Pesan' ?>

                </h2>

                <p class="employee-modal-description">

                    <?= $template
                        ? 'Perbarui template pesan notifikasi yang digunakan sistem.'
                        : 'Buat template pesan notifikasi untuk tamu atau pegawai.' ?>

                </p>

            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeNotificationTemplateEdit"
                aria-label="Tutup modal">

                <i
                    class="bi bi-x-lg"
                    aria-hidden="true"></i>

            </button>

        </div>

        <?php if (! empty($errors)): ?>

            <div
                class="employee-form-alert"
                role="alert">

                <i
                    class="bi bi-exclamation-circle-fill"
                    aria-hidden="true">
                </i>

                <div>
                    Terdapat kesalahan pada formulir.
                    Silakan periksa kembali data yang diisi.
                </div>

            </div>

        <?php endif; ?>

        <form
            id="notificationTemplateForm"
            action="<?= $template
                        ? base_url(
                            'admin/bukutamu-template-pesan/edit/'
                                . $template['id']
                        )
                        : base_url(
                            'admin/bukutamu-template-pesan/tambah'
                        ) ?>"
            method="post"
            novalidate>

            <?= csrf_field() ?>


            <div class="employee-modal-body">


                <div class="setting-form-section">

                    <div class="setting-form-section-heading">

                        <div class="setting-form-section-icon">

                            <i
                                class="bi bi-people"
                                aria-hidden="true"></i>

                        </div>

                        <div>

                            <h3 class="setting-form-section-title">
                                Penerima
                            </h3>

                            <p class="setting-form-section-description">
                                Tentukan penerima pesan notifikasi.
                            </p>

                        </div>

                    </div>


                    <div>

                        <label
                            for="notificationTemplateRecipient"
                            class="employee-form-label">

                            Penerima

                        </label>


                        <select
                            class="form-select employee-form-input <?= ! empty($errors['recipient_type']) ? 'is-invalid' : '' ?>"
                            id="notificationTemplateRecipient"
                            name="recipient_type"
                            required>

                            <option value="">
                                Pilih penerima
                            </option>

                            <option
                                value="guest"
                                <?= old(
                                    'recipient_type',
                                    $formData['recipient_type']
                                        ?? $template['recipient_type']
                                        ?? ''
                                ) === 'guest'
                                    ? 'selected'
                                    : '' ?>>

                                Tamu

                            </option>

                            <option
                                value="employee"
                                <?= old(
                                    'recipient_type',
                                    $formData['recipient_type']
                                        ?? $template['recipient_type']
                                        ?? ''
                                ) === 'employee'
                                    ? 'selected'
                                    : '' ?>>

                                Pegawai

                            </option>

                        </select>

                        <?php if (! empty($errors['recipient_type'])): ?>

                            <div class="invalid-feedback">
                                <?= esc($errors['recipient_type']) ?>
                            </div>

                        <?php endif; ?>

                    </div>

                </div>


                <div class="setting-form-section">

                    <div class="setting-form-section-heading">

                        <div class="setting-form-section-icon">

                            <i
                                class="bi bi-bell"
                                aria-hidden="true"></i>

                        </div>

                        <div>

                            <h3 class="setting-form-section-title">
                                Jenis Notifikasi
                            </h3>

                            <p class="setting-form-section-description">
                                Tentukan jenis notifikasi yang menggunakan
                                template ini.
                            </p>

                        </div>

                    </div>


                    <div>

                        <label
                            for="notificationTemplateType"
                            class="employee-form-label">

                            Jenis Notifikasi

                        </label>


                        <select
                            class="form-select employee-form-input <?= ! empty($errors['notification_type']) ? 'is-invalid' : '' ?>"
                            id="notificationTemplateType"
                            name="notification_type"
                            required>

                            <option value="">
                                Pilih jenis notifikasi
                            </option>

                            <option
                                value="registration_success"
                                <?= old(
                                    'notification_type',
                                    $formData['notification_type']
                                        ?? $template['notification_type']
                                        ?? ''
                                ) === 'registration_success'
                                    ? 'selected'
                                    : '' ?>>

                                Registrasi Berhasil

                            </option>

                            <option
                                value="check_in"
                                <?= old(
                                    'notification_type',
                                    $formData['notification_type']
                                        ?? $template['notification_type']
                                        ?? ''
                                ) === 'check_in'
                                    ? 'selected'
                                    : '' ?>>

                                Check-in

                            </option>

                            <option
                                value="visit_warning"
                                <?= old(
                                    'notification_type',
                                    $formData['notification_type']
                                        ?? $template['notification_type']
                                        ?? ''
                                ) === 'visit_warning'
                                    ? 'selected'
                                    : '' ?>>

                                Peringatan Kunjungan

                            </option>

                            <option
                                value="check_out"
                                <?= old(
                                    'notification_type',
                                    $formData['notification_type']
                                        ?? $template['notification_type']
                                        ?? ''
                                ) === 'check_out'
                                    ? 'selected'
                                    : '' ?>>

                                Check-out

                            </option>

                        </select>

                        <?php if (! empty($errors['notification_type'])): ?>

                            <div class="invalid-feedback">
                                <?= esc($errors['notification_type']) ?>
                            </div>

                        <?php endif; ?>

                    </div>

                </div>


                <div class="setting-form-section">

                    <div class="setting-form-section-heading">

                        <div class="setting-form-section-icon">

                            <i
                                class="bi bi-chat-left-text"
                                aria-hidden="true"></i>

                        </div>

                        <div>

                            <h3 class="setting-form-section-title">
                                Isi Pesan
                            </h3>

                            <p class="setting-form-section-description">
                                Masukkan isi pesan yang akan dikirim
                                kepada penerima.
                            </p>

                        </div>

                    </div>


                    <div>

                        <label
                            for="notificationTemplateMessage"
                            class="employee-form-label">

                            Isi Pesan

                        </label>


                        <textarea
                            class="form-control employee-form-input <?= ! empty($errors['template_message']) ? 'is-invalid' : '' ?>"
                            id="notificationTemplateMessage"
                            name="template_message"
                            rows="6"
                            placeholder="Masukkan isi pesan notifikasi..."
                            required><?= esc(
                                            old(
                                                'template_message',
                                                $formData['template_message']
                                                    ?? $template['template_message']
                                                    ?? ''
                                            )
                                        ) ?></textarea>

                        <?php if (! empty($errors['template_message'])): ?>

                            <div class="invalid-feedback">
                                <?= esc($errors['template_message']) ?>
                            </div>

                        <?php endif; ?>

                        <div class="form-text mt-2">
                            Gunakan isi pesan yang sesuai dengan
                            jenis notifikasi yang dipilih.
                        </div>

                    </div>

                </div>


                <div class="setting-form-section">

                    <div class="setting-form-section-heading">

                        <div class="setting-form-section-icon">

                            <i
                                class="bi bi-toggle-on"
                                aria-hidden="true"></i>

                        </div>

                        <div>

                            <h3 class="setting-form-section-title">
                                Status Template
                            </h3>

                            <p class="setting-form-section-description">
                                Tentukan apakah template dapat digunakan
                                oleh sistem.
                            </p>

                        </div>

                    </div>


                    <div class="setting-toggle-list">


                        <div class="setting-toggle-item">

                            <div class="setting-toggle-content">

                                <span class="setting-toggle-title">
                                    Status Aktif
                                </span>

                                <span class="setting-toggle-description">
                                    Template aktif dapat digunakan
                                    untuk mengirim notifikasi.
                                </span>

                            </div>


                            <label
                                class="setting-switch"
                                for="notificationTemplateActive">

                                <input
                                    type="hidden"
                                    name="active"
                                    value="0">

                                <input
                                    type="checkbox"
                                    id="notificationTemplateActive"
                                    name="active"
                                    value="1"
                                    <?= (
                                        (int) old(
                                            'active',
                                            $formData['active']
                                                ?? $template['active']
                                                ?? 1
                                        ) === 1
                                    )
                                        ? 'checked'
                                        : '' ?>>

                                <span
                                    class="setting-switch-slider"
                                    aria-hidden="true">
                                </span>

                            </label>

                        </div>


                    </div>

                </div>


            </div>

            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelNotificationTemplateEdit">

                    Batal

                </button>


                <button
                    type="submit"
                    class="btn employee-button-primary rounded-pill">

                    <i
                        class="bi bi-check2-circle me-2"
                        aria-hidden="true"></i>

                    <?= $template
                        ? 'Simpan Perubahan'
                        : 'Simpan Template' ?>

                </button>

            </div>

        </form>

    </div>

</div>