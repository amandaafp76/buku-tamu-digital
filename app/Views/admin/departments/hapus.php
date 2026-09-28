<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i class="bi bi-trash3"></i>
            </div>

            <div class="employee-modal-heading">

                <h1 class="employee-modal-title">
                    Hapus Bagian/Departemen
                </h1>

                <p class="employee-modal-description">
                    Konfirmasi penghapusan data Bagian/Departemen.
                </p>

            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeHapusDepartemen"
                aria-label="Tutup">

                <i class="bi bi-x-lg"></i>

            </button>

        </div>


        <form
            id="formHapusDepartemen"
            action="<?= base_url('admin/bukutamu-departemen/hapus/' . $department['id']) ?>"
            method="post">

            <?= csrf_field() ?>


            <div class="employee-modal-body">

                <div class="employee-delete-message">

                    <p class="mb-3">
                        Apakah kamu yakin ingin menghapus
                        Bagian/Departemen berikut?
                    </p>


                    <div class="employee-delete-summary">

                        <div class="employee-delete-summary-item">

                            <div class="employee-delete-summary-icon">
                                <i class="bi bi-building"></i>
                            </div>

                            <div class="employee-delete-summary-content">

                                <span class="employee-delete-summary-label">
                                    Nama Bagian/Departemen
                                </span>

                                <strong class="employee-delete-summary-value">
                                    <?= esc($department['name']) ?>
                                </strong>

                            </div>

                        </div>


                        <div class="employee-delete-summary-item">

                            <div class="employee-delete-summary-icon">
                                <i class="bi bi-people"></i>
                            </div>

                            <div class="employee-delete-summary-content">

                                <span class="employee-delete-summary-label">
                                    Jumlah Pegawai
                                </span>

                                <span class="employee-delete-summary-value">

                                    <?= number_format(
                                        (int) ($employeeCount ?? 0),
                                        0,
                                        ',',
                                        '.'
                                    ) ?>

                                    Pegawai

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

                                    <?= (bool) $department['active']
                                        ? 'Aktif'
                                        : 'Nonaktif' ?>

                                </span>

                            </div>

                        </div>

                    </div>


                    <?php if ((int) ($employeeCount ?? 0) > 0): ?>

                        <div class="employee-delete-warning mt-4">

                            <i class="bi bi-exclamation-triangle"></i>

                            <span>
                                Bagian/Departemen ini masih digunakan
                                oleh
                                <?= number_format(
                                    (int) $employeeCount,
                                    0,
                                    ',',
                                    '.'
                                ) ?>
                                pegawai dan tidak dapat dihapus.
                            </span>

                        </div>

                    <?php else: ?>

                        <div class="employee-delete-warning mt-4">

                            <i class="bi bi-exclamation-triangle"></i>

                            <span>
                                Data Bagian/Departemen yang sudah dihapus
                                tidak dapat dikembalikan.
                            </span>

                        </div>

                    <?php endif; ?>

                </div>

            </div>


            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelHapusDepartemen">

                    Batal

                </button>


                <?php if ((int) ($employeeCount ?? 0) === 0): ?>

                    <button
                        type="submit"
                        class="btn employee-button-danger rounded-pill">

                        <i class="bi bi-trash3 me-1"></i>

                        Hapus Bagian/Departemen

                    </button>

                <?php else: ?>

                    <button
                        type="button"
                        class="btn employee-button-secondary rounded-pill"
                        disabled>

                        <i class="bi bi-lock me-1"></i>

                        Tidak Dapat Dihapus

                    </button>

                <?php endif; ?>

            </div>

        </form>

    </div>

</div>