<?php
$errors = $errors ?? session()->getFlashdata('errors') ?? [];
$error  = $error ?? session()->getFlashdata('error');
?>

<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i class="bi bi-pencil-square"></i>
            </div>

            <div class="employee-modal-heading">
                <h1 class="employee-modal-title">
                    Edit Data Kunjungan
                </h1>

                <p class="employee-modal-description">
                    Perbaiki data tamu dan data kunjungan.
                </p>
            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeEditKunjungan"
                aria-label="Tutup">
                <i class="bi bi-x-lg"></i>
            </button>

        </div>

        <?php if ($error): ?>
            <div class="employee-form-alert">
                <i class="bi bi-exclamation-circle"></i>
                <span><?= esc($error) ?></span>
            </div>
        <?php endif; ?>

        <form
            action="<?= site_url('admin/bukutamu-kunjungan/update/' . $visit['id']) ?>"
            method="post"
            data-offline-guard>

            <?= csrf_field() ?>

            <div class="employee-modal-body">

                <h3 class="employee-modal-section-title">Data Tamu</h3>
                <p class="text-muted small mb-3">Identitas dasar tamu.</p>

                <div class="row g-3">

                    <div class="col-12">
                        <label for="guest_name" class="form-label employee-form-label">
                            Nama Lengkap
                        </label>
                        <input
                            type="text"
                            name="guest_name"
                            id="guest_name"
                            class="form-control employee-form-input <?= isset($errors['guest_name']) ? 'is-invalid' : '' ?>"
                            value="<?= esc(old('guest_name', $visit['guest_name'])) ?>"
                            required>
                        <?php if (isset($errors['guest_name'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['guest_name']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="phone" class="form-label employee-form-label">
                            Nomor HP
                        </label>
                        <input
                            type="text"
                            name="phone"
                            id="phone"
                            class="form-control employee-form-input <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
                            value="<?= esc(old('phone', $visit['phone'])) ?>"
                            required>
                        <?php if (isset($errors['phone'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['phone']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="institution" class="form-label employee-form-label">
                            Asal Instansi / Perusahaan
                        </label>
                        <input
                            type="text"
                            name="institution"
                            id="institution"
                            class="form-control employee-form-input <?= isset($errors['institution']) ? 'is-invalid' : '' ?>"
                            value="<?= esc(old('institution', $visit['institution'])) ?>"
                            required>
                        <?php if (isset($errors['institution'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['institution']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12">
                        <label for="address" class="form-label employee-form-label">
                            Alamat
                        </label>
                        <textarea
                            name="address"
                            id="address"
                            class="form-control employee-form-input <?= isset($errors['address']) ? 'is-invalid' : '' ?>"
                            rows="2"
                            required><?= esc(old('address', $visit['address'])) ?></textarea>
                        <?php if (isset($errors['address'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['address']) ?></div>
                        <?php endif; ?>
                    </div>

                </div>

                <h3 class="employee-modal-section-title mt-4">Identitas</h3>
                <p class="text-muted small mb-3">Jenis dan nomor identitas.</p>

                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <label for="identity_type" class="form-label employee-form-label">
                            Jenis Identitas
                        </label>
                        <select
                            name="identity_type"
                            id="identity_type"
                            class="form-select employee-form-input <?= isset($errors['identity_type']) ? 'is-invalid' : '' ?>"
                            required>

                            <option value="" disabled <?= empty(old('identity_type', $visit['identity_type'])) ? 'selected' : '' ?>>
                                Pilih jenis identitas
                            </option>

                            <?php foreach (['KTP', 'SIM', 'PASPOR', 'LAINNYA'] as $type): ?>
                                <option
                                    value="<?= esc($type) ?>"
                                    <?= old('identity_type', $visit['identity_type']) === $type ? 'selected' : '' ?>>
                                    <?= esc($type) ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                        <?php if (isset($errors['identity_type'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['identity_type']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="identity_no" class="form-label employee-form-label">
                            Nomor Identitas
                        </label>
                        <input
                            type="text"
                            name="identity_no"
                            id="identity_no"
                            class="form-control employee-form-input <?= isset($errors['identity_no']) ? 'is-invalid' : '' ?>"
                            value="<?= esc(old('identity_no', $visit['identity_no'])) ?>"
                            required>
                        <?php if (isset($errors['identity_no'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['identity_no']) ?></div>
                        <?php endif; ?>
                    </div>

                </div>

                <h3 class="employee-modal-section-title mt-4">Data Kunjungan</h3>
                <p class="text-muted small mb-3">Tujuan dan informasi kunjungan.</p>

                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <label for="department_id" class="form-label employee-form-label">
                            Bagian / Departemen
                        </label>
                        <select
                            name="department_id"
                            id="department_id"
                            class="form-select employee-form-input <?= isset($errors['department_id']) ? 'is-invalid' : '' ?>"
                            required>

                            <option value="">Pilih Bagian / Departemen</option>

                            <?php foreach ($departments as $department): ?>
                                <option
                                    value="<?= esc($department['id']) ?>"
                                    <?= (int) old('department_id', $visit['department_id']) === (int) $department['id'] ? 'selected' : '' ?>>
                                    <?= esc($department['name']) ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                        <?php if (isset($errors['department_id'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['department_id']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="employee_id" class="form-label employee-form-label">
                            Pegawai Tujuan
                        </label>
                        <select
                            name="employee_id"
                            id="employee_id"
                            class="form-select employee-form-input <?= isset($errors['employee_id']) ? 'is-invalid' : '' ?>"
                            required>

                            <option value="">Pilih Pegawai Tujuan</option>

                            <?php foreach ($employees as $employee): ?>
                                <option
                                    value="<?= esc($employee['id']) ?>"
                                    data-department="<?= esc($employee['department_id']) ?>"
                                    <?= (int) old('employee_id', $visit['employee_id']) === (int) $employee['id'] ? 'selected' : '' ?>>
                                    <?= esc($employee['employee_name']) ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                        <?php if (isset($errors['employee_id'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['employee_id']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="purpose_id" class="form-label employee-form-label">
                            Keperluan Kunjungan
                        </label>
                        <select
                            name="purpose_id"
                            id="purpose_id"
                            class="form-select employee-form-input <?= isset($errors['purpose_id']) ? 'is-invalid' : '' ?>"
                            required>

                            <option value="">Pilih Keperluan Kunjungan</option>

                            <?php foreach ($purposes as $purpose): ?>
                                <option
                                    value="<?= esc($purpose['id']) ?>"
                                    <?= (int) old('purpose_id', $visit['purpose_id']) === (int) $purpose['id'] ? 'selected' : '' ?>>
                                    <?= esc($purpose['purpose_name']) ?>
                                </option>
                            <?php endforeach; ?>

                        </select>
                        <?php if (isset($errors['purpose_id'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['purpose_id']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="group_size" class="form-label employee-form-label">
                            Jumlah Rombongan
                        </label>
                        <input
                            type="number"
                            name="group_size"
                            id="group_size"
                            class="form-control employee-form-input <?= isset($errors['group_size']) ? 'is-invalid' : '' ?>"
                            min="1"
                            max="100"
                            value="<?= esc(old('group_size', $visit['group_size'])) ?>"
                            required>
                        <?php if (isset($errors['group_size'])): ?>
                            <div class="invalid-feedback"><?= esc($errors['group_size']) ?></div>
                        <?php endif; ?>
                    </div>

                </div>

            </div>

            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelEditKunjungan">
                    Batal
                </button>

                <button
                    type="submit"
                    class="btn employee-button-primary rounded-pill">
                    <i class="bi bi-check-lg me-1"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>