const dashboardData = document.getElementById('dashboard-data');

const rootStyles = getComputedStyle(document.documentElement);

const primaryColor =
    rootStyles.getPropertyValue('--color-primary').trim();

const primaryDarkColor =
    rootStyles.getPropertyValue('--color-primary-dark').trim();

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

const primarySoft = hexToRgba(primaryColor, 0.10);
const primaryMedium = hexToRgba(primaryColor, 0.72);

const primaryPalette = [
    hexToRgba(primaryColor, 0.95),
    hexToRgba(primaryColor, 0.80),
    hexToRgba(primaryColor, 0.65),
    hexToRgba(primaryColor, 0.50),
    hexToRgba(primaryColor, 0.35),
    hexToRgba(primaryColor, 0.20)
];

if (dashboardData) {

    const dailyVisitData = JSON.parse(
        dashboardData.dataset.dailyVisits
    );

    const hourlyVisitData = JSON.parse(
        dashboardData.dataset.hourlyVisits
    );

    const statusChartData = JSON.parse(
        dashboardData.dataset.statusChart
    );

    const departmentChartData = JSON.parse(
        dashboardData.dataset.departmentVisits
    );

    const employeeChartData = JSON.parse(
        dashboardData.dataset.employeeVisits
    );

    const dailyVisitLabels = dailyVisitData.map(
        item => item.visit_date
    );

    const dailyVisitValues = dailyVisitData.map(
        item => Number(item.total_visits)
    );

    const dailyVisitsChart = document.getElementById(
        'dailyVisitsChart'
    );

    if (dailyVisitsChart) {

        new Chart(dailyVisitsChart, {
            type: 'line',

            data: {
                labels: dailyVisitLabels,

                datasets: [{
                    label: 'Kunjungan',
                    data: dailyVisitValues,

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
                }]
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
                        }
                    },

                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    }

        // Bar Chart - Jam Kunjungan Terpadat

    const hourlyVisitLabels = hourlyVisitData.map(
        item => `${String(item.visit_hour).padStart(2, '0')}:00`
    );

    const hourlyVisitValues = hourlyVisitData.map(
        item => Number(item.total_visits)
    );

    const hourlyVisitsChart = document.getElementById(
        'hourlyVisitsChart'
    );

    if (hourlyVisitsChart) {

        new Chart(hourlyVisitsChart, {
            type: 'bar',

            data: {
                labels: hourlyVisitLabels,

                datasets: [{
                    label: 'Kunjungan',
                    data: hourlyVisitValues,

                    backgroundColor: primaryMedium,
                    borderColor: primaryColor,

                    hoverBackgroundColor: primaryDarkColor,
                    hoverBorderColor: primaryDarkColor,

                    borderWidth: 1,

                    borderRadius: 10,

                    maxBarThickness: 36
                }]
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
        });
    }

    // Donut Chart - Status Kunjungan

    const statusChartLabels = Object.keys(
        statusChartData
    );

    const statusChartValues = Object.values(
        statusChartData
    ).map(value => Number(value));

    const statusVisitsChart = document.getElementById(
        'statusVisitsChart'
    );

    if (statusVisitsChart) {

        new Chart(statusVisitsChart, {
            type: 'doughnut',

            data: {
                labels: statusChartLabels,

                datasets: [{
                    data: statusChartValues,

                    backgroundColor: primaryPalette,

                    borderColor: 'rgba(255, 255, 255, 0.70)',
                    borderWidth: 2
                }]
            },

            options: {
                responsive: true,

                maintainAspectRatio: false,

                cutout: '68%',

                plugins: {
                    legend: {
                        position: 'bottom',

                        labels: {
                            font: {
                                family: 'Poppins',
                                size: 11
                            },

                            padding: 14,

                            usePointStyle: true
                        }
                    }
                }
            }
        });
    }


    // Bar Chart - Kunjungan Berdasarkan Departemen

const departmentChartLabels = departmentChartData.map(
    item => item.department_name
);

const departmentChartValues = departmentChartData.map(
    item => Number(item.total_visits)
);

const departmentVisitsChart = document.getElementById(
    'departmentVisitsChart'
);

if (departmentVisitsChart) {

    new Chart(departmentVisitsChart, {
        type: 'bar',

        data: {
            labels: departmentChartLabels,

            datasets: [{
                label: 'Kunjungan',
                data: departmentChartValues,

                backgroundColor: primaryMedium,
                borderColor: primaryColor,

                hoverBackgroundColor: primaryDarkColor,
                hoverBorderColor: primaryDarkColor,

                borderWidth: 1,

                borderRadius: 10,

                maxBarThickness: 48
            }]
        },

        options: {
            responsive: true,

            indexAxis: 'y',

            maintainAspectRatio: false,

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
    });
}


// Bar Chart - Kunjungan Berdasarkan Pegawai

const employeeChartLabels = employeeChartData.map(
    item => item.employee_name
);

const employeeChartValues = employeeChartData.map(
    item => Number(item.total_visits)
);

const employeeVisitsChart = document.getElementById(
    'employeeVisitsChart'
);

if (employeeVisitsChart) {

    new Chart(employeeVisitsChart, {
        type: 'bar',

        data: {
            labels: employeeChartLabels,

            datasets: [{
                label: 'Kunjungan',
                data: employeeChartValues,

                backgroundColor: primaryMedium,
                borderColor: primaryColor,

                hoverBackgroundColor: primaryDarkColor,
                hoverBorderColor: primaryDarkColor,

                borderWidth: 1,

                borderRadius: 10,

                maxBarThickness: 48
            }]
        },

        options: {
            responsive: true,

            indexAxis: 'y',

            maintainAspectRatio: false,

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
    });
}
}