<?php
$errors = $errors ?? session()->getFlashdata('errors') ?? [];
$error  = $error ?? session()->getFlashdata('error');
?>

<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i class="bi-clipboard-check"></i>
            </div>

            <div class="employee-modal-heading">
                <h1 class="employee-modal-title">
                    Edit Data Kunjungan
                </h1>

                <p class="employee-modal-description">
                    Perbaiki data kunjungan
                </p>
            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeEditKunjunganPetugas"
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
            action="<?= site_url('petugas/bukutamu-kunjungan/update/' . $visit['id']) ?>"
            method="post"
            data-offline-guard>

            <?= csrf_field() ?>

            <div class="employee-modal-body">

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
                    id="cancelEditKunjunganPetugas">
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