<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="employee-modal-overlay is-open">

    <div class="employee-modal-overlay-backdrop"></div>

    <div class="employee-modal-container">

        <div class="employee-modal-wrapper">

            <div class="employee-modal glass-modal">

                <div class="employee-modal-header">

                    <div class="employee-modal-icon">
                        <i class="bi bi-trash3"></i>
                    </div>

                    <div class="employee-modal-heading">

                        <h1 class="employee-modal-title">
                            Hapus Kunjungan
                        </h1>

                        <p class="employee-modal-description">
                            Konfirmasi penghapusan data kunjungan.
                        </p>

                    </div>

                    <button
                        type="button"
                        class="employee-modal-close"
                        id="closeHapusKunjungan"
                        aria-label="Tutup">

                        <i class="bi bi-x-lg"></i>

                    </button>

                </div>


                <form
                    id="deleteVisitForm"
                    action="<?= base_url('admin/bukutamu-kunjungan/hapus/' . $visit['id']) ?>"
                    method="post">

                    <?= csrf_field() ?>


                    <div class="employee-modal-body">

                        <div class="employee-delete-message">

                            <p class="mb-3">
                                Apakah kamu yakin ingin menghapus data kunjungan berikut?
                            </p>


                            <div class="employee-delete-summary">


                                <div class="employee-delete-summary-item">

                                    <div class="employee-delete-summary-icon">
                                        <i class="bi bi-upc-scan"></i>
                                    </div>

                                    <div class="employee-delete-summary-content">

                                        <span class="employee-delete-summary-label">
                                            Kode Kunjungan
                                        </span>

                                        <strong class="employee-delete-summary-value">
                                            <?= esc($visit['visit_code']) ?>
                                        </strong>

                                    </div>

                                </div>


                                <div class="employee-delete-summary-item">

                                    <div class="employee-delete-summary-icon">
                                        <i class="bi bi-person"></i>
                                    </div>

                                    <div class="employee-delete-summary-content">

                                        <span class="employee-delete-summary-label">
                                            Nama Tamu
                                        </span>

                                        <strong class="employee-delete-summary-value">
                                            <?= esc($visit['guest_name']) ?>
                                        </strong>

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
                                            <?= esc($visit['department_name'] ?? '-') ?>
                                        </span>

                                    </div>

                                </div>


                                <div class="employee-delete-summary-item">

                                    <div class="employee-delete-summary-icon">
                                        <i class="bi bi-person-badge"></i>
                                    </div>

                                    <div class="employee-delete-summary-content">

                                        <span class="employee-delete-summary-label">
                                            Pegawai Tujuan
                                        </span>

                                        <span class="employee-delete-summary-value">
                                            <?= esc($visit['employee_name'] ?? '-') ?>
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
                                            <?= esc($visit['status'] ?? '-') ?>
                                        </span>

                                    </div>

                                </div>


                            </div>


                            <div class="employee-delete-warning mt-4">

                                <i class="bi bi-exclamation-triangle"></i>

                                <span>
                                    Data kunjungan yang sudah dihapus tidak dapat dikembalikan.
                                </span>

                            </div>


                        </div>

                    </div>


                    <div class="employee-modal-footer">

                        <button
                            type="button"
                            class="btn employee-button-secondary rounded-pill"
                            id="cancelHapusKunjungan">

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn employee-button-danger rounded-pill">

                            <i class="bi bi-trash3 me-1"></i>
                            Hapus Kunjungan

                        </button>

                    </div>


                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('pageJs') ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const closeButton =
            document.getElementById('closeHapusKunjungan');

        const cancelButton =
            document.getElementById('cancelHapusKunjungan');

        const detailUrl =
            "<?= site_url('admin/bukutamu-kunjungan/detail/' . $visit['id']) ?>";


        function kembaliKeDetail() {

            window.location.href = detailUrl;

        }


        if (closeButton) {

            closeButton.addEventListener(
                'click',
                kembaliKeDetail
            );

        }


        if (cancelButton) {

            cancelButton.addEventListener(
                'click',
                kembaliKeDetail
            );

        }

    });
</script>

<?= $this->endSection() ?>