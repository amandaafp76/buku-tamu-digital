<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">
                <i class="bi bi-trash3"></i>
            </div>

            <div class="employee-modal-heading">

                <h1 class="employee-modal-title">
                    Hapus Pengguna
                </h1>

                <p class="employee-modal-description">
                    Konfirmasi penghapusan data pengguna.
                </p>

            </div>

            <button
                type="button"
                class="employee-modal-close"
                id="closeHapusPengguna"
                aria-label="Tutup">

                <i class="bi bi-x-lg"></i>

            </button>

        </div>


        <form
            id="deleteUserForm"
            action="<?= base_url('admin/bukutamu-pengguna/hapus/' . $user['id']) ?>"
            method="post">

            <?= csrf_field() ?>


            <div class="employee-modal-body">

                <div class="employee-delete-message">

                    <p class="mb-3">
                        Apakah kamu yakin ingin menghapus
                        pengguna berikut?
                    </p>


                    <div class="employee-delete-summary">

                        <!-- Username -->

                        <div class="employee-delete-summary-item">

                            <div class="employee-delete-summary-icon">

                                <i class="bi bi-person"></i>

                            </div>

                            <div class="employee-delete-summary-content">

                                <span class="employee-delete-summary-label">
                                    Username
                                </span>

                                <strong class="employee-delete-summary-value">
                                    <?= esc($user['username']) ?>
                                </strong>

                            </div>

                        </div>


                        <!-- Role -->

                        <div class="employee-delete-summary-item">

                            <div class="employee-delete-summary-icon">

                                <i class="bi bi-person-badge"></i>

                            </div>

                            <div class="employee-delete-summary-content">

                                <span class="employee-delete-summary-label">
                                    Role
                                </span>

                                <span class="employee-delete-summary-value">

                                    <?php
                                    $roleLabels = [
                                        'administrator' => 'Administrator',
                                        'petugas'       => 'Petugas',
                                    ];
                                    ?>

                                    <?= esc(
                                        $roleLabels[$user['role']]
                                            ?? ucfirst($user['role'])
                                    ) ?>

                                </span>

                            </div>

                        </div>


                        <!-- Status -->

                        <div class="employee-delete-summary-item">

                            <div class="employee-delete-summary-icon">

                                <i class="bi bi-circle-half"></i>

                            </div>

                            <div class="employee-delete-summary-content">

                                <span class="employee-delete-summary-label">
                                    Status
                                </span>

                                <span class="employee-delete-summary-value">

                                    <?= (bool) $user['active']
                                        ? 'Aktif'
                                        : 'Nonaktif' ?>

                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="employee-delete-warning mt-4">

                        <i class="bi bi-exclamation-triangle"></i>

                        <span>
                            Data pengguna yang sudah dihapus
                            tidak dapat dikembalikan.
                        </span>

                    </div>

                </div>

            </div>


            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelHapusPengguna">

                    Batal

                </button>


                <button
                    type="submit"
                    class="btn employee-button-danger rounded-pill">

                    <i class="bi bi-trash3 me-1"></i>

                    Hapus Pengguna

                </button>

            </div>

        </form>

    </div>

</div>