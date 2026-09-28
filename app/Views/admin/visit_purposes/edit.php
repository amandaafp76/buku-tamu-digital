<?php

$errors = $errors ?? session()->getFlashdata('errors') ?? [];
$error  = $error ?? session()->getFlashdata('error');

$formData = $formData ?? [];

?>

<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i class="bi bi-signpost-2"></i>
            </div>

            <div class="employee-modal-heading">

                <h1 class="employee-modal-title">
                    Edit Tujuan Kunjungan
                </h1>

                <p class="employee-modal-description">
                    Perbarui data tujuan kunjungan.
                </p>

            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeEditTujuanKunjungan"
                aria-label="Tutup">

                <i class="bi bi-x-lg"></i>

            </button>

        </div>

        <?php if ($error): ?>

            <div class="employee-form-alert">

                <i class="bi bi-exclamation-circle"></i>

                <span>
                    <?= esc($error) ?>
                </span>

            </div>

        <?php endif; ?>

        <form
            action="<?= base_url('admin/bukutamu-tujuan/edit/' . $visitPurpose['id']) ?>"
            method="post"
            novalidate>

            <?= csrf_field() ?>

            <div class="employee-modal-body">

                <div class="row g-4">

                    <div class="col-12">

                        <label
                            for="purpose_name_edit"
                            class="form-label employee-form-label">

                            Nama Tujuan Kunjungan

                        </label>

                        <input
                            type="text"
                            id="purpose_name_edit"
                            name="purpose_name"
                            class="form-control employee-form-input <?= isset($errors['purpose_name']) ? 'is-invalid' : '' ?>"
                            placeholder="Masukkan nama tujuan kunjungan"
                            value="<?= esc(
                                        old(
                                            'purpose_name',
                                            $formData['purpose_name'] ?? $visitPurpose['purpose_name']
                                        )
                                    ) ?>"
                            minlength="3"
                            maxlength="50"
                            autocomplete="organization">

                        <div
                            id="purposeNameEditError"
                            class="invalid-feedback">

                            <?php if (isset($errors['purpose_name'])): ?>
                                <?= esc($errors['purpose_name']) ?>
                            <?php endif; ?>

                        </div>

                    </div>

                    <div class="col-12">

                        <label
                            for="purpose_active_edit"
                            class="form-label employee-form-label">

                            Status

                        </label>

                        <select
                            id="purpose_active_edit"
                            name="active"
                            class="form-select employee-form-input <?= isset($errors['active']) ? 'is-invalid' : '' ?>">

                            <option
                                value="1"
                                <?= (string) old(
                                    'active',
                                    $formData['active'] ?? $visitPurpose['active']
                                ) === '1' ? 'selected' : '' ?>>

                                Aktif

                            </option>

                            <option
                                value="0"
                                <?= (string) old(
                                    'active',
                                    $formData['active'] ?? $visitPurpose['active']
                                ) === '0' ? 'selected' : '' ?>>

                                Nonaktif

                            </option>

                        </select>

                        <div
                            id="purposeActiveEditError"
                            class="invalid-feedback">

                            <?php if (isset($errors['active'])): ?>
                                <?= esc($errors['active']) ?>
                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>

            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelEditTujuanKunjungan">

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