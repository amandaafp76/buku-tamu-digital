document.addEventListener(
    'DOMContentLoaded',
    () => {

        const form =
            document.getElementById(
                'photoForm'
            );

        if (!form) {
            return;
        }


        const cameraPreview =
            document.getElementById(
                'cameraPreview'
            );

        const photoPreview =
            document.getElementById(
                'photoPreview'
            );

        const photoPlaceholder =
            document.getElementById(
                'photoPlaceholder'
            );

        const photoCanvas =
            document.getElementById(
                'photoCanvas'
            );

        const photoInput =
            document.getElementById(
                'photoInput'
            );
        
        const photoUploadDivider =
            document.getElementById(
                'photoUploadDivider'
            );

        const photoUploadArea =
            document.getElementById(
                'photoUploadArea'
            );

        const openCameraButton =
            document.getElementById(
                'openCameraButton'
            );

        const capturePhotoButton =
            document.getElementById(
                'capturePhotoButton'
            );

        const retakePhotoButton =
            document.getElementById(
                'retakePhotoButton'
            );

        const photoContinueButton =
            document.getElementById(
                'photoContinueButton'
            );

        const cameraStatus =
            document.getElementById(
                'cameraStatus'
            );

        const photoError =
            document.getElementById(
                'photoError'
            );

        const photoErrorMessage =
            document.getElementById(
                'photoErrorMessage'
            );

        const photoPreviewModal =
            document.getElementById(
                'photoPreviewModal'
            );

        const modalPhotoContinueButton =
            document.getElementById(
                'modalPhotoContinueButton'
            );


        let cameraStream = null;

        let currentPhotoFile = null;

        let currentPreviewUrl = null;


        const requirePhoto =
            window.photoConfig?.requirePhoto ?? true;

        const MAX_FILE_SIZE =
            window.photoConfig?.maxFileSize ??
            (500 * 1024);

        const MAX_INPUT_FILE_SIZE =
            10 * 1024 * 1024;

        const MAX_WIDTH = 1280;

        const MAX_HEIGHT = 1280;


        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];

        function showError(message) {

            photoErrorMessage.textContent =
                message;

            photoError.hidden = false;

        }


        function clearError() {

            photoErrorMessage.textContent = '';

            photoError.hidden = true;

        }

        function showPhotoUploadFallback() {

            if (photoUploadArea) {
                photoUploadArea.hidden = false;
            }

        }


        function hidePhotoUploadFallback() {

            if (photoUploadArea) {
                photoUploadArea.hidden = true;
            }

        }

        function updateStatus(
            icon,
            message
        ) {

            cameraStatus.innerHTML = `
                <i
                    class="bi ${icon}"
                    aria-hidden="true">
                </i>

                <span>
                    ${message}
                </span>
            `;

        }


        function stopCamera() {

            if (!cameraStream) {
                return;
            }

            cameraStream
                .getTracks()
                .forEach(
                    track => track.stop()
                );

            cameraStream = null;

        }


        function clearPreviewUrl() {

            if (currentPreviewUrl) {

                URL.revokeObjectURL(
                    currentPreviewUrl
                );

                currentPreviewUrl = null;

            }

        }

        function showPhotoPreview(file) {

            clearPreviewUrl();

            currentPreviewUrl =
                URL.createObjectURL(file);

            photoPreview.src =
                currentPreviewUrl;

            currentPhotoFile =
                file;

            openPhotoPreviewModal();

            updateStatus(
                'bi-check-circle',
                'Foto berhasil diproses. Silakan periksa hasil foto.'
            );

        }

        function closePhotoPreviewModal() {

            if (!photoPreviewModal) {
                return;
            }

            photoPreviewModal.hidden = true;

            photoPreviewModal.setAttribute(
                'aria-hidden',
                'true'
            );

            document.body.classList.remove(
                'photo-modal-open'
            );

        }

        function openPhotoPreviewModal() {

            if (!photoPreviewModal) {
                return;
            }

            photoPreviewModal.hidden = false;

            photoPreviewModal.setAttribute(
                'aria-hidden',
                'false'
            );

            document.body.classList.add(
                'photo-modal-open'
            );

        }

        function setPhotoFile(file) {

            const dataTransfer =
                new DataTransfer();

            dataTransfer.items.add(file);

            photoInput.files =
                dataTransfer.files;

        }


        async function compressImage(file) {

            const image =
                new Image();

            const imageUrl =
                URL.createObjectURL(file);

            try {

                image.src =
                    imageUrl;

                await new Promise(
                    (
                        resolve,
                        reject
                    ) => {

                        image.onload =
                            resolve;

                        image.onerror =
                            reject;

                    }
                );


                let width =
                    image.naturalWidth;

                let height =
                    image.naturalHeight;


                const scale =
                    Math.min(
                        1,
                        MAX_WIDTH / width,
                        MAX_HEIGHT / height
                    );


                width =
                    Math.round(
                        width * scale
                    );

                height =
                    Math.round(
                        height * scale
                    );


                photoCanvas.width =
                    width;

                photoCanvas.height =
                    height;


                const context =
                    photoCanvas.getContext(
                        '2d'
                    );


                context.clearRect(
                    0,
                    0,
                    width,
                    height
                );


                context.drawImage(
                    image,
                    0,
                    0,
                    width,
                    height
                );


                let quality = 0.85;

                let blob =
                    await canvasToBlob(
                        photoCanvas,
                        quality
                    );


                while (
                    blob.size > MAX_FILE_SIZE &&
                    quality > 0.30
                ) {

                    quality -= 0.05;

                    blob =
                        await canvasToBlob(
                            photoCanvas,
                            quality
                        );

                }


                if (
                    blob.size >
                    MAX_FILE_SIZE
                ) {

                    throw new Error(
                        'Foto masih terlalu besar setelah kompresi.'
                    );

                }


                return new File(
                    [
                        blob
                    ],
                    createFileName(),
                    {
                        type:
                            'image/jpeg',
                        lastModified:
                            Date.now()
                    }
                );

            } finally {

                URL.revokeObjectURL(
                    imageUrl
                );

            }

        }


        function canvasToBlob(
            canvas,
            quality
        ) {

            return new Promise(
                (
                    resolve,
                    reject
                ) => {

                    canvas.toBlob(
                        blob => {

                            if (!blob) {

                                reject(
                                    new Error(
                                        'Gagal memproses foto.'
                                    )
                                );

                                return;

                            }

                            resolve(blob);

                        },
                        'image/jpeg',
                        quality
                    );

                }
            );

        }


        function createFileName() {

            const randomPart =
                Math.random()
                    .toString(36)
                    .substring(2, 12);

            const timestamp =
                Date.now();

            return `
                photo_${timestamp}_${randomPart}.jpg
            `.replace(
                /\s/g,
                ''
            );

        }


        async function processPhoto(file) {

            clearError();


            if (!file) {

                showError(
                    'Silakan pilih foto terlebih dahulu.'
                );

                return false;

            }


            if (
                !allowedTypes.includes(
                    file.type
                )
            ) {

                showError(
                    'Format foto tidak didukung. Gunakan JPG, JPEG, PNG, atau WebP.'
                );

                return false;

            }


            if (
                file.size >
                MAX_INPUT_FILE_SIZE
            ) {

                showError(
                    'Ukuran foto terlalu besar. Maksimal file awal adalah 10 MB.'
                );

                return false;

            }


            try {

                const compressedFile =
                    await compressImage(
                        file
                    );


                currentPhotoFile =
                    compressedFile;


                setPhotoFile(
                    compressedFile
                );


                showPhotoPreview(
                    compressedFile
                );


                updateStatus(
                    'bi-check-circle',
                    'Foto berhasil diproses dan siap digunakan.'
                );


                return true;

            } catch (error) {

                console.error(
                    error
                );

                showError(
                    error.message ||
                    'Foto gagal diproses.'
                );

                return false;

            }

        }


        async function openCamera() {

            clearError();

            stopCamera();


            if (
                !navigator.mediaDevices ||
                !navigator.mediaDevices.getUserMedia
            ) {

                showPhotoUploadFallback();

                updateStatus(
                    'bi-exclamation-circle',
                    'Kamera tidak tersedia pada browser atau perangkat ini.'
                );

                showError(
                    'Browser atau perangkat tidak mendukung akses kamera. Silakan pilih foto dari perangkat sebagai alternatif.'
                );

                return;

            }

            try {

                cameraStream =
                    await navigator
                        .mediaDevices
                        .getUserMedia(
                            {
                                video: {
                                    facingMode: {
                                        ideal: 'user'
                                    }
                                },
                                audio: false
                            }
                        );


                hidePhotoUploadFallback();


                cameraPreview.srcObject =
                    cameraStream;


                cameraPreview.hidden =
                    false;

                photoPlaceholder.hidden =
                    true;

                capturePhotoButton.hidden =
                    false;

                openCameraButton.hidden =
                    true;

                retakePhotoButton.hidden =
                    true;


                updateStatus(
                    'bi-camera',
                    'Kamera aktif. Posisikan wajah Anda di dalam area kamera.'
                );

            } catch (error) {

                console.error(
                    error
                );


                stopCamera();


                openCameraButton.hidden =
                    false;

                capturePhotoButton.hidden =
                    true;


                if (
                    error.name === 'NotAllowedError'
                ) {

                    showPhotoUploadFallback();


                    updateStatus(
                        'bi-exclamation-circle',
                        'Akses kamera ditolak. Silakan gunakan foto dari perangkat sebagai alternatif.'
                    );


                    showError(
                        'Akses kamera ditolak. Silakan pilih foto dari perangkat sebagai alternatif.'
                    );

                    return;

                }


                updateStatus(
                    'bi-exclamation-circle',
                    'Kamera tidak dapat digunakan. Silakan gunakan foto dari perangkat sebagai alternatif.'
                );

                showPhotoUploadFallback();

                showError(
                    'Kamera tidak dapat digunakan pada perangkat ini. Silakan pilih foto dari perangkat sebagai alternatif.'
                );

            }

        }


        async function capturePhoto() {

            if (!cameraStream) {

                return;

            }


            const videoWidth =
                cameraPreview.videoWidth;

            const videoHeight =
                cameraPreview.videoHeight;


            if (
                !videoWidth ||
                !videoHeight
            ) {

                showError(
                    'Kamera belum siap. Silakan tunggu beberapa saat lalu coba lagi.'
                );

                return;

            }


            photoCanvas.width =
                videoWidth;

            photoCanvas.height =
                videoHeight;


            const context =
                photoCanvas.getContext(
                    '2d'
                );


            context.drawImage(
                cameraPreview,
                0,
                0,
                videoWidth,
                videoHeight
            );


            const blob =
                await canvasToBlob(
                    photoCanvas,
                    0.85
                );


            const cameraFile =
                new File(
                    [
                        blob
                    ],
                    createFileName(),
                    {
                        type:
                            'image/jpeg',
                        lastModified:
                            Date.now()
                    }
                );


            stopCamera();


            const processed =
                await processPhoto(
                    cameraFile
                );


            if (!processed) {
                return;
            }


            cameraPreview.hidden =
                false;

            photoPlaceholder.hidden =
                true;

            capturePhotoButton.hidden =
                true;

            openCameraButton.hidden =
                false;

        }

        function resetPhoto() {

            clearError();

            stopCamera();

            clearPreviewUrl();

            hidePhotoUploadFallback();


            currentPhotoFile =
                null;


            photoInput.value =
                '';


            cameraPreview.srcObject =
                null;


            cameraPreview.hidden =
                true;

            photoPlaceholder.hidden =
                false;

            capturePhotoButton.hidden =
                true;

            openCameraButton.hidden =
                false;


            closePhotoPreviewModal();


            photoPreview.removeAttribute(
                'src'
            );


            updateStatus(
                'bi-info-circle',
                'Kamera belum digunakan.'
            );

        }

        function continueFromPhotoModal() {

            if (!currentPhotoFile) {

                showError(
                    'Foto belum tersedia. Silakan ambil atau pilih foto terlebih dahulu.'
                );

                return;

            }

            closePhotoPreviewModal();

            form.requestSubmit();

        }

        hidePhotoUploadFallback();

        openCameraButton.addEventListener(
            'click',
            openCamera
        );


        capturePhotoButton.addEventListener(
            'click',
            capturePhoto
        );


        retakePhotoButton.addEventListener(
            'click',
            resetPhoto
        );


        if (modalPhotoContinueButton) {

            modalPhotoContinueButton.addEventListener(
                'click',
                continueFromPhotoModal
            );

        }


        photoInput.addEventListener(
            'change',
            async () => {

                const file =
                    photoInput.files[0];

                if (!file) {
                    return;
                }

                stopCamera();

                await processPhoto(
                    file
                );

            }
        );

       form.addEventListener(
            'submit',
            event => {

                if (!requirePhoto) {
                    return;
                }

                if (
                    !currentPhotoFile ||
                    !photoInput.files.length
                ) {

                    event.preventDefault();

                    showError(
                        'Foto wajib diambil atau dipilih sebelum melanjutkan.'
                    );

                }

            }
        );


        window.addEventListener(
            'beforeunload',
            stopCamera
        );


        document.addEventListener(
            'visibilitychange',
            () => {

                if (
                    document.hidden
                ) {

                    stopCamera();

                }

            }
        );

    }
    
);