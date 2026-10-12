document.addEventListener(
    'DOMContentLoaded',
    function () {

        const form =
            document.getElementById(
                'activityLogFilterForm'
            );

        const searchInput =
            document.getElementById(
                'activityLogSearch'
            );

        const actionInput =
            document.getElementById(
                'activityLogAction'
            );

        const entityInput =
            document.getElementById(
                'activityLogEntity'
            );

        const resetButton =
            document.getElementById(
                'resetActivityLogFilter'
            );

        const tableContainer =
            document.getElementById(
                'activityLogTableContainer'
            );


        if (
            !form ||
            !searchInput ||
            !actionInput ||
            !entityInput ||
            !resetButton ||
            !tableContainer
        ) {
            return;
        }


        const loadActivityLogs =
            async function () {

                const params =
                    new URLSearchParams(
                        new FormData(form)
                    );


                const url =
                    form.getAttribute('action') +
                    '?' +
                    params.toString();

                const response =
                    await fetch(
                        url,
                        {
                            headers: {
                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    );


                if (!response.ok) {

                    throw new Error(
                        'Gagal mengambil data activity log.'
                    );

                }


                const html =
                    await response.text();


                tableContainer.innerHTML =
                    html;

            };

            tableContainer.addEventListener(
                'click',
                async function (event) {

                    const paginationLink =
                        event.target.closest(
                            '.admin-pagination a'
                        );

                    if (!paginationLink) {
                        return;
                    }

                    event.preventDefault();

                    const url =
                        paginationLink.href;

                    if (!url) {
                        return;
                    }

                    try {

                        const response =
                            await fetch(
                                url,
                                {
                                    headers: {
                                        'X-Requested-With':
                                            'XMLHttpRequest'
                                    }
                                }
                            );

                        if (!response.ok) {

                            throw new Error(
                                'Gagal mengambil halaman activity log.'
                            );

                        }

                        const html =
                            await response.text();

                        tableContainer.innerHTML =
                            html;

                    } catch (error) {

                        console.error(
                            'Gagal memuat pagination activity log:',
                            error
                        );

                    }

                }
            );

            form.addEventListener(
            'submit',
            function (event) {

                event.preventDefault();

            }
        );

        let searchTimeout;


        searchInput.addEventListener(
            'input',
            function () {

                clearTimeout(
                    searchTimeout
                );


                searchTimeout =
                    setTimeout(
                        function () {

                            loadActivityLogs();

                        },
                        400
                    );

            }
        );


        actionInput.addEventListener(
            'change',
            function () {

                loadActivityLogs();

            }
        );


        entityInput.addEventListener(
            'change',
            function () {

                loadActivityLogs();

            }
        );


        resetButton.addEventListener(
            'click',
            function () {

                searchInput.value = '';

                actionInput.value = '';

                entityInput.value = '';

                loadActivityLogs();

            }
        );

    }
);