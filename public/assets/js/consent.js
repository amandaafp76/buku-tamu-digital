document.addEventListener(
    'DOMContentLoaded',
    () => {

        const form =
            document.getElementById(
                'consentForm'
            );

        if (!form) {
            return;
        }


        const canvas =
            document.getElementById(
                'signatureCanvas'
            );

        const signatureInput =
            document.getElementById(
                'signatureInput'
            );

        const clearButton =
            document.getElementById(
                'clearSignatureButton'
            );

        const signatureError =
            document.getElementById(
                'signatureError'
            );


        if (
            !canvas ||
            !signatureInput ||
            !clearButton
        ) {
            return;
        }


        const context =
            canvas.getContext('2d');


        let isDrawing = false;

        let hasSignature = false;


        function setupCanvas() {

            const rect =
                canvas.getBoundingClientRect();


            const ratio =
                window.devicePixelRatio || 1;


            canvas.width =
                rect.width * ratio;

            canvas.height =
                rect.height * ratio;


            context.setTransform(
                ratio,
                0,
                0,
                ratio,
                0,
                0
            );


            context.lineWidth = 2.5;

            context.lineCap = 'round';

            context.lineJoin = 'round';

            context.strokeStyle =
                '#352323';

        }


        function getPosition(event) {

            const rect =
                canvas.getBoundingClientRect();


            return {
                x:
                    event.clientX -
                    rect.left,

                y:
                    event.clientY -
                    rect.top
            };

        }


        function startDrawing(event) {

            event.preventDefault();

            isDrawing = true;

            hasSignature = true;


            const position =
                getPosition(event);


            context.beginPath();

            context.moveTo(
                position.x,
                position.y
            );

        }


        function draw(event) {

            if (!isDrawing) {
                return;
            }


            event.preventDefault();


            const position =
                getPosition(event);


            context.lineTo(
                position.x,
                position.y
            );

            context.stroke();

        }


        function stopDrawing(event) {

            if (!isDrawing) {
                return;
            }


            event.preventDefault();

            isDrawing = false;

            context.closePath();

        }


        function clearSignature() {

            context.clearRect(
                0,
                0,
                canvas.width,
                canvas.height
            );


            hasSignature = false;

            signatureInput.value = '';

            clearError();

        }


        function clearError() {

            signatureError.textContent = '';

            signatureError.classList.remove(
                'is-visible'
            );

        }


        function showError(message) {

            signatureError.textContent =
                message;

            signatureError.classList.add(
                'is-visible'
            );

        }


        function saveSignature() {

            if (!hasSignature) {

                signatureInput.value = '';

                return false;

            }


            signatureInput.value =
                canvas.toDataURL(
                    'image/png'
                );


            return true;

        }


        canvas.addEventListener(
            'pointerdown',
            startDrawing
        );


        canvas.addEventListener(
            'pointermove',
            draw
        );


        canvas.addEventListener(
            'pointerup',
            stopDrawing
        );


        canvas.addEventListener(
            'pointercancel',
            stopDrawing
        );


        canvas.addEventListener(
            'pointerleave',
            stopDrawing
        );


        clearButton.addEventListener(
            'click',
            clearSignature
        );


        form.addEventListener(
            'submit',
            event => {

                clearError();


                if (!saveSignature()) {

                    event.preventDefault();

                    showError(
                        'Silakan berikan tanda tangan terlebih dahulu.'
                    );

                    return;

                }

            }
        );


        setupCanvas();


        window.addEventListener(
            'resize',
            () => {

                if (!hasSignature) {
                    setupCanvas();
                }

            }
        );

    }
);