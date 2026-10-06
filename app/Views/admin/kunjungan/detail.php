<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <div class="mb-4">

        <a
            href="<?= site_url('admin/bukutamu-kunjungan') ?>"
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

    <div class="col-12">

        <div class="glass-card p-4">

            <h5 class="mb-3">
                Aksi Kunjungan
            </h5>

            <p class="text-muted mb-3">
                Administrator dapat memperbaiki data kunjungan
                atau menghapus data yang sudah tidak diperlukan.
            </p>

            <div class="d-flex flex-wrap gap-2">

                <?php if ($visit['status'] === 'Menunggu'): ?>

                    <a
                        href="<?= site_url('admin/bukutamu-kunjungan/edit/' . $visit['id']) ?>"
                        class="btn btn-primary">

                        <i class="bi bi-pencil-square"></i>
                        Edit Data

                    </a>

                <?php endif; ?>

                <a
                    href="<?= site_url('admin/bukutamu-kunjungan/hapus/' . $visit['id']) ?>"
                    class="btn btn-danger">

                    <i class="bi bi-trash"></i>
                    Hapus Kunjungan

                </a>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>