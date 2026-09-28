<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">
            <div class="employee-modal-icon">
                <i class="bi bi-building-gear" aria-hidden="true"></i>
            </div>

            <div class="employee-modal-heading">
                <h2 class="employee-modal-title">
                    Edit Identitas Institusi
                </h2>

                <p class="employee-modal-description">
                    Perbarui informasi identitas institusi yang digunakan pada sistem.
                </p>
            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeInstitutionEdit"
                aria-label="Tutup modal">
                <i class="bi bi-x-lg" aria-hidden="true"></i>
            </button>
        </div>

        <?php if (isset($validation)): ?>
            <div class="employee-form-alert" role="alert">
                <i class="bi bi-exclamation-circle-fill" aria-hidden="true"></i>

                <div>
                    <?= $validation->listErrors() ?>
                </div>
            </div>
        <?php endif; ?>

        <form
            id="institutionEditForm"
            action="<?= base_url('admin/bukutamu-identitas-institusi/update') ?>"
            method="post"
            enctype="multipart/form-data"
            novalidate>

            <?= csrf_field() ?>

            <div class="employee-modal-body">

                <div class="mb-4">
                    <label
                        for="institutionName"
                        class="employee-form-label">
                        Nama Instansi
                    </label>

                    <input
                        type="text"
                        class="form-control employee-form-input"
                        id="institutionName"
                        name="name"
                        value="<?= esc(old('name', $institution['name'] ?? '')) ?>"
                        maxlength="100">

                    <div
                        id="institutionNameError"
                        class="invalid-feedback">
                    </div>
                </div>

                <div class="mb-4">

                    <label
                        for="institutionAddress"
                        class="employee-form-label">
                        Alamat
                    </label>

                    <textarea
                        class="form-control employee-form-input"
                        id="institutionAddress"
                        name="address"
                        rows="4"
                        maxlength="1000"><?= esc(
                                                old(
                                                    'address',
                                                    $institution['address'] ?? ''
                                                )
                                            ) ?></textarea>

                    <div
                        id="institutionAddressError"
                        class="invalid-feedback">
                    </div>

                </div>

                <div class="row g-4">

                    <div class="col-12 col-md-6">

                        <label
                            for="institutionPhone"
                            class="employee-form-label">
                            Nomor Telepon
                        </label>

                        <input
                            type="text"
                            class="form-control employee-form-input"
                            id="institutionPhone"
                            name="phone"
                            value="<?= esc(
                                        old(
                                            'phone',
                                            $institution['phone'] ?? ''
                                        )
                                    ) ?>"
                            maxlength="17">

                        <div
                            id="institutionPhoneError"
                            class="invalid-feedback">
                        </div>

                    </div>

                    <div class="col-12 col-md-6">

                        <label
                            for="institutionEmail"
                            class="employee-form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            class="form-control employee-form-input"
                            id="institutionEmail"
                            name="email"
                            value="<?= esc(
                                        old(
                                            'email',
                                            $institution['email'] ?? ''
                                        )
                                    ) ?>"
                            maxlength="60">

                        <div
                            id="institutionEmailError"
                            class="invalid-feedback">
                        </div>

                    </div>

                </div>

                <div class="mt-4">

                    <label
                        for="institutionLogo"
                        class="employee-form-label">
                        Logo Institusi
                    </label>

                    <input
                        type="file"
                        class="form-control employee-form-input"
                        id="institutionLogo"
                        name="logo"
                        accept="image/png,image/jpeg,image/webp">

                    <div class="form-text mt-2">
                        Format yang diperbolehkan: PNG, JPG/JPEG, atau WebP.
                        Maksimal 2 MB.
                    </div>

                    <div
                        id="institutionLogoError"
                        class="invalid-feedback">
                    </div>

                    <?php if (!empty($institution['logo'])): ?>

                        <div class="institution-edit-logo-preview mt-3">

                            <span class="institution-edit-logo-label">
                                Logo saat ini
                            </span>

                            <img
                                src="<?= base_url($institution['logo']) ?>"
                                alt="Logo <?= esc($institution['name']) ?>"
                                class="institution-edit-logo-image"
                                id="institutionCurrentLogoPreview">

                        </div>

                    <?php endif; ?>

                    <div
                        class="institution-edit-logo-preview mt-3"
                        id="institutionNewLogoPreview"
                        style="display: none;">

                        <span class="institution-edit-logo-label">
                            Preview logo baru
                        </span>

                        <img
                            src=""
                            alt="Preview logo baru"
                            class="institution-edit-logo-image"
                            id="institutionNewLogoPreviewImage">

                    </div>

                </div>

            </div>

            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelInstitutionEdit">
                    Batal
                </button>

                <button
                    type="submit"
                    class="btn employee-button-primary rounded-pill">
                    <i class="bi bi-check2-circle me-2" aria-hidden="true"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>