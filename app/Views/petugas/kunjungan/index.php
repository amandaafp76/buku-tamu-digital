<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1>
                Daftar Kunjungan
            </h1>

            <p class="text-muted mb-0">
                Melihat dan mencari data kunjungan tamu.
            </p>

        </div>

    </div>


    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger">

            <?= esc(session()->getFlashdata('error')) ?>

        </div>

    <?php endif; ?>


    <div class="glass-card p-4 mb-4">

        <form
            action="<?= site_url('petugas/bukutamu-kunjungan') ?>"
            method="get">

            <div class="row g-3">

                <div class="col-md-5">

                    <label class="form-label">
                        Cari Kunjungan
                    </label>

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        value="<?= esc($keyword) ?>"
                        placeholder="Nama, kode, nomor HP, bagian, atau pegawai">

                </div>


                <div class="col-md-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="Menunggu"
                            <?= $status === 'Menunggu' ? 'selected' : '' ?>>
                            Menunggu
                        </option>

                        <option
                            value="Masih Berkunjung"
                            <?= $status === 'Masih Berkunjung' ? 'selected' : '' ?>>
                            Masih Berkunjung
                        </option>

                        <option
                            value="Selesai"
                            <?= $status === 'Selesai' ? 'selected' : '' ?>>
                            Selesai
                        </option>

                        <option
                            value="Ditolak"
                            <?= $status === 'Ditolak' ? 'selected' : '' ?>>
                            Ditolak
                        </option>

                        <option
                            value="Dibatalkan"
                            <?= $status === 'Dibatalkan' ? 'selected' : '' ?>>
                            Dibatalkan
                        </option>

                    </select>

                </div>


                <div class="col-md-2">

                    <label class="form-label">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="date"
                        class="form-control"
                        value="<?= esc($date) ?>">

                </div>


                <div class="col-md-2 d-flex align-items-end">

                    <button
                        type="submit"
                        class="btn btn-primary w-100">

                        <i class="bi bi-search"></i>
                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

    <div class="glass-card p-4">

        <?= $this->include('components/kunjungan/table', [
            'detailBaseUrl' => 'petugas/bukutamu-kunjungan',
        ]) ?>

    </div>
</div>

<?= $this->endSection() ?>