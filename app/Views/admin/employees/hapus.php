<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i class="bi bi-trash3"></i>
            </div>

            <div class="employee-modal-heading">
                <h1 class="employee-modal-title">
                    Hapus Pegawai
                </h1>

                <p class="employee-modal-description">
                    Konfirmasi penghapusan data pegawai.
                </p>
            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeHapusPegawai"
                aria-label="Tutup">
                <i class="bi bi-x-lg"></i>
            </button>

        </div>

        <form
            id="deleteEmployeeForm"
            action="<?= base_url('admin/bukutamu-pegawai/hapus/' . $employee['id']) ?>"
            method="post">

            <?= csrf_field() ?>

            <div class="employee-modal-body">

                <div class="employee-delete-message">

                    <p class="mb-3">
                        Apakah kamu yakin ingin menghapus data pegawai berikut?
                    </p>

                    <div class="employee-delete-summary">

                        <div class="employee-delete-summary-item">

                            <div class="employee-delete-summary-icon">
                                <i class="bi bi-person"></i>
                            </div>

                            <div class="employee-delete-summary-content">
                                <span class="employee-delete-summary-label">
                                    Nama Pegawai
                                </span>

                                <strong class="employee-delete-summary-value">
                                    <?= esc($employee['employee_name']) ?>
                                </strong>
                            </div>

                        </div>

                        <div class="employee-delete-summary-item">

                            <div class="employee-delete-summary-icon">
                                <i class="bi bi-telephone"></i>
                            </div>

                            <div class="employee-delete-summary-content">
                                <span class="employee-delete-summary-label">
                                    Nomor HP
                                </span>

                                <span class="employee-delete-summary-value">
                                    <?= esc($employee['phone'] ?? '-') ?>
                                </span>
                            </div>

                        </div>

                        <div class="employee-delete-summary-item">

                            <div class="employee-delete-summary-icon">
                                <i class="bi bi-building"></i>
                            </div>

                            <div class="employee-delete-summary-content">
                                <span class="employee-delete-summary-label">
                                    Bagian/Departemen
                                </span>

                                <span class="employee-delete-summary-value">
                                    <?= esc($employee['department_name'] ?? '-') ?>
                                </span>
                            </div>

                        </div>

                        <div class="employee-delete-summary-item">

                            <div class="employee-delete-summary-icon">
                                <i class="bi bi-circle-half"></i>
                            </div>

                            <div class="employee-delete-summary-content">
                                <span class="employee-delete-summary-label">
                                    Status
                                </span>

                                <span class="employee-delete-summary-value">
                                    <?= (bool) $employee['active'] ? 'Aktif' : 'Nonaktif' ?>
                                </span>
                            </div>

                        </div>

                    </div>

                    <div class="employee-delete-warning mt-4">

                        <i class="bi bi-exclamation-triangle"></i>

                        <span>
                            Data pegawai yang sudah dihapus tidak dapat dikembalikan.
                        </span>

                    </div>

                </div>

            </div>

            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelHapusPegawai">
                    Batal
                </button>

                <button
                    type="submit"
                    class="btn employee-button-danger rounded-pill">
                    <i class="bi bi-trash3 me-1"></i>
                    Hapus Pegawai
                </button>

            </div>

        </form>

    </div>

</div>