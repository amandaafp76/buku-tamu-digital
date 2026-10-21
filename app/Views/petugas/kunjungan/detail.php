<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('pageCss') ?>

<link
    rel="stylesheet"
    href="<?= base_url('assets/css/dashboard.css') ?>">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="visit-page">

    <div class="dashboard-header mb-4">

        <div class="dashboard-header-text">

            <div>

                <h1 class="dashboard-heading">
                    Detail Kunjungan
                </h1>

                <p class="dashboard-subheading">
                    Informasi lengkap data kunjungan tamu.
                </p>

            </div>

        </div>

    </div>

    <?= $this->include('components/kunjungan/informasi') ?>

    <?php if ($visit['status'] === 'Menunggu'): ?>

        <div class="glass-card detail-action-card">

            <div class="detail-action-header">

                <div class="detail-action-icon">
                    <i class="bi bi-gear"></i>
                </div>

                <div>

                    <h2 class="detail-action-title">
                        Aksi Kunjungan
                    </h2>

                    <p class="detail-action-description">
                        Periksa data kunjungan sebelum menentukan tindakan.
                        Jika data sudah sesuai, lakukan verifikasi dan check-in.
                        Jika kunjungan tidak dapat diterima atau dibatalkan,
                        pilih tindakan yang sesuai.
                    </p>

                </div>

            </div>

            <div class="detail-action-buttons">

                <div class="detail-action-primary-group">

                    <form
                        id="form-verifikasi-check-in"
                        action="<?= site_url('petugas/bukutamu-kunjungan/verifikasi-check-in/' . $visit['id']) ?>"
                        method="post">

                        <?= csrf_field() ?>

                        <button
                            type="submit"
                            class="dashboard-primary-button"
                            data-confirm-form="form-verifikasi-check-in"
                            data-confirm-title="Konfirmasi Verifikasi & Check-In"
                            data-confirm-message="Apakah Anda yakin data kunjungan ini sudah sesuai dan ingin melakukan verifikasi serta check-in?"
                            data-confirm-submit="Ya, Verifikasi & Check-In">

                            <i class="bi bi-check-circle"></i>
                            Verifikasi & Check-In

                        </button>

                    </form>

                    <form
                        id="form-tolak"
                        action="<?= site_url('petugas/bukutamu-kunjungan/tolak/' . $visit['id']) ?>"
                        method="post">

                        <?= csrf_field() ?>

                        <button
                            type="submit"
                            class="btn btn-danger"
                            data-confirm-form="form-tolak"
                            data-confirm-title="Konfirmasi Tolak"
                            data-confirm-message="Apakah Anda yakin ingin menolak kunjungan ini?"
                            data-confirm-submit="Ya, Tolak">

                            <i class="bi bi-x-circle"></i>
                            Tolak

                        </button>

                    </form>

                    <form
                        id="form-batalkan"
                        action="<?= site_url('petugas/bukutamu-kunjungan/batalkan/' . $visit['id']) ?>"
                        method="post">

                        <?= csrf_field() ?>

                        <button
                            type="submit"
                            class="btn btn-outline-secondary"
                            data-confirm-form="form-batalkan"
                            data-confirm-title="Konfirmasi Pembatalan"
                            data-confirm-message="Apakah Anda yakin ingin membatalkan kunjungan ini?"
                            data-confirm-submit="Ya, Batalkan">

                            <i class="bi bi-x-lg"></i>
                            Batalkan

                        </button>

                    </form>

                    <a
                        href="<?= site_url(
                                    'petugas/bukutamu-kunjungan/edit/' . $visit['id']
                                ) ?>"
                        class="dashboard-secondary-button">

                        <i class="bi bi-pencil-square"></i>
                        Edit Data

                    </a>

                </div>

                <div class="detail-action-navigation">

                    <a
                        href="<?= site_url('petugas/bukutamu-kunjungan') ?>"
                        class="detail-danger-button">

                        <i class="bi bi-arrow-left"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>

    <?php endif; ?>

    <?php if ($visit['status'] === 'Masih Berkunjung'): ?>

        <div class="glass-card detail-action-card">

            <div class="detail-action-header">

                <div class="detail-action-icon">
                    <i class="bi bi-gear"></i>
                </div>

                <div>

                    <h2 class="detail-action-title">
                        Aksi Kunjungan
                    </h2>

                    <p class="detail-action-description">
                        Tamu masih tercatat sedang berkunjung.
                        Jika tamu telah selesai berkunjung dan QR tidak dapat digunakan,
                        lakukan check-out secara manual.
                    </p>

                </div>

            </div>

            <div class="detail-action-buttons">

                <div class="detail-action-primary-group">

                    <form
                        id="form-checkout-manual"
                        action="<?= site_url('petugas/bukutamu-kunjungan/check-out-manual/' . $visit['id']) ?>"
                        method="post">

                        <?= csrf_field() ?>

                        <button
                            type="submit"
                            class="dashboard-primary-button"
                            data-confirm-form="form-checkout-manual"
                            data-confirm-title="Konfirmasi Check-Out"
                            data-confirm-message="Apakah Anda yakin ingin melakukan check-out manual untuk kunjungan ini?"
                            data-confirm-submit="Ya, Check-Out">

                            <i class="bi bi-box-arrow-right"></i>
                            Check-Out Manual

                        </button>

                    </form>

                </div>

                <div class="detail-action-navigation">

                    <a
                        href="<?= site_url('petugas/bukutamu-kunjungan') ?>"
                        class="detail-danger-button">

                        <i class="bi bi-arrow-left"></i>
                        Kembali

                    </a>

                </div>

            </div>

        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>