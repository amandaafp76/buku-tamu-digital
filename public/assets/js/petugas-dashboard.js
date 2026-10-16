document.addEventListener('DOMContentLoaded', function () {

     const rootStyles = getComputedStyle(
        document.documentElement
    );

    const primaryColor = rootStyles
        .getPropertyValue('--color-primary')
        .trim();

    const primaryDarkColor = rootStyles
        .getPropertyValue('--color-primary-dark')
        .trim();

    function hexToRgba(hex, alpha = 1) {

        hex = hex.replace('#', '');

        if (hex.length === 3) {
            hex = hex
                .split('')
                .map(char => char + char)
                .join('');
        }

        const r = parseInt(hex.substring(0, 2), 16);
        const g = parseInt(hex.substring(2, 4), 16);
        const b = parseInt(hex.substring(4, 6), 16);

        return `rgba(${r}, ${g}, ${b}, ${alpha})`;
    }

    const primarySoft   = hexToRgba(primaryColor, 0.10);
    const primaryMedium = hexToRgba(primaryColor, 0.72);

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

                            borderColor: primaryColor,
                            backgroundColor: primarySoft,

                            pointBackgroundColor: primaryColor,
                            pointBorderColor: primaryColor,

                            pointHoverBackgroundColor: primaryDarkColor,
                            pointHoverBorderColor: primaryDarkColor,

                            borderWidth: 2,

                            tension: 0.35,

                            fill: true,

                            pointRadius: 4,
                            pointHoverRadius: 6
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
                        x: {
                            grid: {
                                display: false
                            },

                            ticks: {
                                font: {
                                    family: 'Poppins',
                                    size: 11
                                }
                            }
                        },

                        y: {
                            beginAtZero: true,

                            ticks: {
                                precision: 0,

                            font: {
                                family: 'Poppins',
                                size: 11
                                }

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
                            ),

                            backgroundColor: primaryMedium,
                            borderColor: primaryColor,

                            hoverBackgroundColor: primaryDarkColor,
                            hoverBorderColor: primaryDarkColor,

                            borderWidth: 1,
                            borderRadius: 10,
                            maxBarThickness: 36

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
                        x: {
                                grid: {
                                    display: false
                                },

                                ticks: {
                                    font: {
                                        family: 'Poppins',
                                        size: 10
                                    }
                                }
                            },


                        y: {
                            beginAtZero: true,

                            ticks: {
                                precision: 0,

                                font: {
                                    family: 'Poppins',
                                    size: 11
                                }
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
                            ),
                            backgroundColor: primaryMedium,
                            borderColor: primaryColor,

                            hoverBackgroundColor: primaryDarkColor,
                            hoverBorderColor: primaryDarkColor,

                            borderWidth: 1,
                            borderRadius: 10,
                            maxBarThickness: 48

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
                                    precision: 0,

                                font: {
                                    family: 'Poppins',
                                    size: 11
                                }

                            }
                        },

                        y: {
                            grid: {
                                display: false
                            },

                            ticks: {
                                font: {
                                    family: 'Poppins',
                                    size: 11
                                }

                            }

                        }

                    }
                }
            }
        );

    }

});