<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i class="bi bi-trash3"></i>
            </div>

            <div class="employee-modal-heading">

                <h1 class="employee-modal-title">
                    Hapus Tujuan Kunjungan
                </h1>

                <p class="employee-modal-description">
                    Konfirmasi penghapusan data tujuan kunjungan.
                </p>

            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeHapusTujuanKunjungan"
                aria-label="Tutup">

                <i class="bi bi-x-lg"></i>

            </button>

        </div>


        <form
            id="formHapusTujuanKunjungan"
            action="<?= base_url('admin/bukutamu-tujuan/hapus/' . $visitPurpose['id']) ?>"
            method="post">

            <?= csrf_field() ?>


            <div class="employee-modal-body">

                <div class="employee-delete-message">

                    <p class="mb-3">
                        Apakah kamu yakin ingin menghapus
                        tujuan kunjungan berikut?
                    </p>


                    <div class="employee-delete-summary">

                        <div class="employee-delete-summary-item">

                            <div class="employee-delete-summary-icon">

                                <i class="bi bi-signpost-2"></i>

                            </div>

                            <div class="employee-delete-summary-content">

                                <span class="employee-delete-summary-label">
                                    Nama Tujuan Kunjungan
                                </span>

                                <strong class="employee-delete-summary-value">
                                    <?= esc($visitPurpose['purpose_name']) ?>
                                </strong>

                            </div>

                        </div>


                        <div class="employee-delete-summary-item">

                            <div class="employee-delete-summary-icon">

                                <i class="bi bi-calendar2-check"></i>

                            </div>

                            <div class="employee-delete-summary-content">

                                <span class="employee-delete-summary-label">
                                    Jumlah Kunjungan
                                </span>

                                <span class="employee-delete-summary-value">

                                    <?= number_format(
                                        (int) ($visitCount ?? 0),
                                        0,
                                        ',',
                                        '.'
                                    ) ?>

                                    Kunjungan

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

                                    <?= (bool) $visitPurpose['active']
                                        ? 'Aktif'
                                        : 'Nonaktif' ?>

                                </span>

                            </div>

                        </div>

                    </div>


                    <?php if ((int) ($visitCount ?? 0) > 0): ?>

                        <div class="employee-delete-warning mt-4">

                            <i class="bi bi-exclamation-triangle"></i>

                            <span>
                                Tujuan kunjungan ini sudah digunakan
                                pada <?= number_format(
                                            (int) $visitCount,
                                            0,
                                            ',',
                                            '.'
                                        ) ?> kunjungan dan tidak dapat dihapus.
                            </span>

                        </div>

                    <?php else: ?>

                        <div class="employee-delete-warning mt-4">

                            <i class="bi bi-exclamation-triangle"></i>

                            <span>
                                Data tujuan kunjungan yang sudah dihapus
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
                    id="cancelHapusTujuanKunjungan">

                    Batal

                </button>


                <?php if ((int) ($visitCount ?? 0) === 0): ?>

                    <button
                        type="submit"
                        class="btn employee-button-danger rounded-pill">

                        <i class="bi bi-trash3 me-1"></i>

                        Hapus Tujuan Kunjungan

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