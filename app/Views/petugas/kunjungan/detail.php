<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <div class="mb-4">

        <a
            href="<?= site_url('petugas/bukutamu-kunjungan') ?>"
            class="btn btn-sm btn-outline-secondary mb-3">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>

        <h1>Detail Kunjungan</h1>

        <p class="text-muted">
            Informasi lengkap data kunjungan tamu.
        </p>

    </div>

    <?= $this->include('components/kunjungan/informasi') ?>

    <?php if ($visit['status'] === 'Menunggu'): ?>

        <div class="col-12">

            <div class="glass-card p-4">

                <h5 class="mb-3">
                    Aksi Kunjungan
                </h5>

                <p class="text-muted mb-3">
                    Periksa data kunjungan sebelum menentukan tindakan.
                    Jika data sudah sesuai, lakukan verifikasi dan check-in.
                    Jika kunjungan tidak dapat diterima atau dibatalkan,
                    pilih tindakan yang sesuai.
                </p>

                <div class="d-flex flex-wrap gap-2">

                    <a
                        href="<?= site_url(
                                    'petugas/bukutamu-kunjungan/edit/' . $visit['id']
                                ) ?>"
                        class="btn btn-outline-primary">

                        <i class="bi bi-pencil-square"></i>
                        Edit Data

                    </a>

                    <form
                        id="form-verifikasi-check-in"
                        action="<?= site_url('petugas/bukutamu-kunjungan/verifikasi-check-in/' . $visit['id']) ?>"
                        method="post">

                        <?= csrf_field() ?>

                        <button
                            type="submit"
                            class="btn btn-primary"
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

                </div>

            </div>

        </div>

    <?php endif; ?>

    <?php if ($visit['status'] === 'Masih Berkunjung'): ?>

        <div class="col-12">

            <div class="glass-card p-4">

                <h5 class="mb-3">
                    Aksi Kunjungan
                </h5>

                <p class="text-muted mb-3">
                    Tamu masih tercatat sedang berkunjung.
                    Jika tamu telah selesai berkunjung dan QR tidak dapat digunakan,
                    lakukan check-out secara manual.
                </p>

                <form
                    id="form-checkout-manual"
                    action="<?= site_url('petugas/bukutamu-kunjungan/check-out-manual/' . $visit['id']) ?>"
                    method="post">

                    <?= csrf_field() ?>

                    <button
                        type="submit"
                        class="btn btn-primary"
                        data-confirm-form="form-checkout-manual"
                        data-confirm-title="Konfirmasi Check-Out"
                        data-confirm-message="Apakah Anda yakin ingin melakukan check-out manual untuk kunjungan ini?"
                        data-confirm-submit="Ya, Check-Out">

                        <i class="bi bi-box-arrow-right"></i>
                        Check-Out Manual

                    </button>

                </form>

            </div>

        </div>

    <?php endif; ?>

</div>

<?= $this->endSection() ?>