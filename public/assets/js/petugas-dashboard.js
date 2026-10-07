document.addEventListener('DOMContentLoaded', function () {

    const dailyVisits =
        window.petugasDashboardData?.dailyVisits ?? [];

    const hourlyVisits =
        window.petugasDashboardData?.hourlyVisits ?? [];

    const departmentVisits =
        window.petugasDashboardData?.departmentVisits ?? [];

    const dailyCanvas =
        document.getElementById('dailyVisitsChart');

    if (dailyCanvas) {

        new Chart(
            dailyCanvas,
            {
                type: 'line',

                data: {
                    labels: dailyVisits.map(
                        item => item.visit_date
                    ),

                    datasets: [
                        {
                            label: 'Jumlah Kunjungan',

                            data: dailyVisits.map(
                                item =>
                                    Number(
                                        item.total_visits
                                    )
                            ),

                            tension: 0.35,

                            fill: true
                        }
                    ]
                },

                options: {
                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            display: false
                        }
                    },

                    scales: {
                        y: {
                            beginAtZero: true,

                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            }
        );

    }

    const hourlyCanvas =
        document.getElementById('hourlyVisitsChart');

    if (hourlyCanvas) {

        new Chart(
            hourlyCanvas,
            {
                type: 'bar',

                data: {
                    labels: hourlyVisits.map(
                        item =>
                            String(
                                item.visit_hour
                            ).padStart(2, '0') + ':00'
                    ),

                    datasets: [
                        {
                            label: 'Kunjungan',

                            data: hourlyVisits.map(
                                item =>
                                    Number(
                                        item.total_visits
                                    )
                            )
                        }
                    ]
                },

                options: {
                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            display: false
                        }
                    },

                    scales: {
                        y: {
                            beginAtZero: true,

                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            }
        );

    }

    const departmentCanvas =
        document.getElementById(
            'departmentVisitsChart'
        );

    if (
        departmentCanvas &&
        departmentVisits.length > 0
    ) {

        new Chart(
            departmentCanvas,
            {
                type: 'bar',

                data: {
                    labels: departmentVisits.map(
                        item =>
                            item.department_name
                    ),

                    datasets: [
                        {
                            label: 'Jumlah Kunjungan',

                            data: departmentVisits.map(
                                item =>
                                    Number(
                                        item.total_visits
                                    )
                            )
                        }
                    ]
                },

                options: {
                    responsive: true,

                    maintainAspectRatio: false,

                    indexAxis: 'y',

                    plugins: {
                        legend: {
                            display: false
                        }
                    },

                    scales: {
                        x: {
                            beginAtZero: true,

                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            }
        );

    }

});