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
                    Administrator dapat memperbaiki data kunjungan
                    atau menghapus data yang sudah tidak diperlukan.
                </p>

            </div>

        </div>


        <div class="detail-action-buttons">

            <?php if ($visit['status'] === 'Menunggu'): ?>

                <a
                    href="<?= site_url('admin/bukutamu-kunjungan/edit/' . $visit['id']) ?>"
                    class="dashboard-primary-button">

                    <i class="bi bi-pencil-square"></i>
                    Edit Data

                </a>

            <?php endif; ?>

            <a
                href="<?= site_url('admin/bukutamu-kunjungan/hapus/' . $visit['id']) ?>"
                class="detail-danger-button">

                <i class="bi bi-trash"></i>
                Hapus Kunjungan

            </a>

            <a
                href="<?= site_url('admin/bukutamu-kunjungan') ?>"
                class="detail-danger-button">

                <i class="bi bi-arrow-left"></i>
                <span>Kembali</span>

            </a>

        </div>

    </div>

</div>

<?= $this->endSection() ?>