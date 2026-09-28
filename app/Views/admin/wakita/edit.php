<div class="employee-modal-wrapper">

    <div class="employee-modal glass-modal">

        <div class="employee-modal-header">

            <div class="employee-modal-icon">

                <i
                    class="bi bi-chat-square-text"
                    aria-hidden="true"></i>

            </div>


            <div class="employee-modal-heading">

                <h2 class="employee-modal-title">
                    Edit Konfigurasi WAKITA
                </h2>

                <p class="employee-modal-description">
                    Atur status dan koneksi layanan WAKITA.
                </p>

            </div>


            <button
                type="button"
                class="employee-modal-close"
                id="closeWakitaEdit"
                aria-label="Tutup modal">

                <i
                    class="bi bi-x-lg"
                    aria-hidden="true"></i>

            </button>

        </div>

        <?php if (isset($validation)): ?>

            <div
                class="employee-form-alert"
                role="alert">

                <i
                    class="bi bi-exclamation-circle-fill"
                    aria-hidden="true"></i>

                <div>
                    <?= $validation->listErrors() ?>
                </div>

            </div>

        <?php endif; ?>


        <form
            action="<?= base_url('admin/bukutamu-wakita/update') ?>"
            method="post">

            <?= csrf_field() ?>


            <div class="employee-modal-body">


                <div class="setting-form-section">


                    <div class="setting-form-section-heading">

                        <div class="setting-form-section-icon">

                            <i
                                class="bi bi-power"
                                aria-hidden="true"></i>

                        </div>


                        <div>

                            <h3 class="setting-form-section-title">
                                Status WAKITA
                            </h3>

                            <p class="setting-form-section-description">
                                Tentukan apakah layanan WAKITA
                                digunakan dalam sistem buku tamu.
                            </p>

                        </div>

                    </div>


                    <div class="setting-toggle-list">


                        <div class="setting-toggle-item">


                            <div class="setting-toggle-content">

                                <span class="setting-toggle-title">
                                    WAKITA Aktif
                                </span>

                                <span class="setting-toggle-description">
                                    Aktifkan untuk menggunakan layanan
                                    WAKITA dalam sistem.
                                </span>

                            </div>


                            <label
                                class="setting-switch"
                                for="wakitaEnabled">

                                <input
                                    type="hidden"
                                    name="wakita_enabled"
                                    value="0">

                                <input
                                    type="checkbox"
                                    id="wakitaEnabled"
                                    name="wakita_enabled"
                                    value="1"
                                    <?= (
                                        (int) old(
                                            'wakita_enabled',
                                            $setting['wakita_enabled'] ?? 0
                                        ) === 1
                                    ) ? 'checked' : '' ?>>

                                <span
                                    class="setting-switch-slider"
                                    aria-hidden="true">
                                </span>

                            </label>


                        </div>


                    </div>


                </div>

                <div class="setting-form-section">


                    <div class="setting-form-section-heading">

                        <div class="setting-form-section-icon">

                            <i
                                class="bi bi-plug"
                                aria-hidden="true"></i>

                        </div>


                        <div>

                            <h3 class="setting-form-section-title">
                                Konfigurasi Koneksi
                            </h3>

                            <p class="setting-form-section-description">
                                Masukkan informasi koneksi yang
                                digunakan untuk mengakses layanan WAKITA.
                            </p>

                        </div>

                    </div>


                    <div class="mb-3">

                        <label
                            for="wakitaApiUrl"
                            class="employee-form-label">

                            API URL

                        </label>


                        <input
                            type="url"
                            class="form-control employee-form-input"
                            id="wakitaApiUrl"
                            name="wakita_api_url"
                            value="<?= esc(
                                        old(
                                            'wakita_api_url',
                                            $setting['wakita_api_url'] ?? ''
                                        )
                                    ) ?>"
                            maxlength="255"
                            placeholder="https://example.com/api"
                            autocomplete="off">

                    </div>

                    <div class="mb-3">

                        <label
                            for="wakitaApiKey"
                            class="employee-form-label">

                            API Key

                        </label>


                        <input
                            type="password"
                            class="form-control employee-form-input"
                            id="wakitaApiKey"
                            name="wakita_api_key"
                            value="<?= esc(
                                        old(
                                            'wakita_api_key',
                                            $setting['wakita_api_key'] ?? ''
                                        )
                                    ) ?>"
                            maxlength="100"
                            placeholder="Masukkan API Key"
                            autocomplete="new-password">

                    </div>

                    <div>

                        <label
                            for="wakitaSender"
                            class="employee-form-label">

                            Sender

                        </label>


                        <input
                            type="text"
                            class="form-control employee-form-input"
                            id="wakitaSender"
                            name="wakita_sender"
                            value="<?= esc(
                                        old(
                                            'wakita_sender',
                                            $setting['wakita_sender'] ?? ''
                                        )
                                    ) ?>"
                            maxlength="20"
                            placeholder="Contoh: BUKUTAMU"
                            autocomplete="off">

                    </div>


                </div>


            </div>

            <div class="employee-modal-footer">

                <button
                    type="button"
                    class="btn employee-button-secondary rounded-pill"
                    id="cancelWakitaEdit">

                    Batal

                </button>


                <button
                    type="submit"
                    class="btn employee-button-primary rounded-pill">

                    <i
                        class="bi bi-check2-circle me-2"
                        aria-hidden="true"></i>

                    Simpan Perubahan

                </button>

            </div>


        </form>


    </div>

</div>