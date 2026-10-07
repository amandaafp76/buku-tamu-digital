<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VisitModel;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Models\VisitPurposeModel;
use App\Models\UserModel;
use App\Models\SettingModel;

class DashboardController extends BaseController
{
    public function index(): string
    {
        $visitModel = new VisitModel();

        $today = date('Y-m-d');


        $filterStartDate = $this->request->getGet('start_date');
        $filterEndDate   = $this->request->getGet('end_date');

        $isFiltered = false;
        $filterError = '';

        if ($filterStartDate || $filterEndDate) {

            $startDate = \DateTime::createFromFormat(
                'Y-m-d',
                (string) $filterStartDate
            );

            $endDate = \DateTime::createFromFormat(
                'Y-m-d',
                (string) $filterEndDate
            );

            if (
                $startDate &&
                $endDate &&
                $startDate->format('Y-m-d') === $filterStartDate &&
                $endDate->format('Y-m-d') === $filterEndDate &&
                $filterStartDate <= $filterEndDate
            ) {
                $isFiltered = true;
            } else {
                $filterStartDate = '';
                $filterEndDate = '';

                $filterError = 'Rentang tanggal tidak valid.';
            }
        }

        $periodStart = $isFiltered
            ? $filterStartDate
            : null;

        $periodEnd = $isFiltered
            ? $filterEndDate
            : null;

        $weekStart = date('Y-m-d', strtotime('monday this week'));
        $weekEnd   = date('Y-m-d', strtotime('sunday this week'));

        $monthStart = date('Y-m-01');
        $monthEnd   = date('Y-m-t');

        $periodVisits = 0;
        $periodGuests = 0;

        if ($isFiltered) {

            $periodVisits = $visitModel
                ->where(
                    'arrival_time >=',
                    $periodStart . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $periodEnd . ' 23:59:59'
                )
                ->countAllResults();

            $periodGuests = $visitModel
                ->selectSum('group_size', 'total_guests')
                ->where(
                    'arrival_time >=',
                    $periodStart . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $periodEnd . ' 23:59:59'
                )
                ->get()
                ->getRow()
                ->total_guests ?? 0;
        }

        $todayVisits = $visitModel
            ->where('DATE(arrival_time)', $today, false)
            ->countAllResults();

        $todayGuests = $visitModel
            ->selectSum('group_size', 'total_guests')
            ->where('DATE(arrival_time)', $today, false)
            ->get()
            ->getRow()
            ->total_guests ?? 0;

        $weekVisits = $visitModel
            ->where('DATE(arrival_time) >=', $weekStart)
            ->where('DATE(arrival_time) <=', $weekEnd)
            ->countAllResults();

        $weekGuests = $visitModel
            ->selectSum('group_size', 'total_guests')
            ->where('DATE(arrival_time) >=', $weekStart)
            ->where('DATE(arrival_time) <=', $weekEnd)
            ->get()
            ->getRow()
            ->total_guests ?? 0;

        $monthVisits = $visitModel
            ->where('DATE(arrival_time) >=', $monthStart)
            ->where('DATE(arrival_time) <=', $monthEnd)
            ->countAllResults();

        $monthGuests = $visitModel
            ->selectSum('group_size', 'total_guests')
            ->where('DATE(arrival_time) >=', $monthStart)
            ->where('DATE(arrival_time) <=', $monthEnd)
            ->get()
            ->getRow()
            ->total_guests ?? 0;

        $totalEmployees = (new EmployeeModel())->countAllResults();
        $totalDepartments = (new DepartmentModel())->countAllResults();
        $totalPurposes = (new VisitPurposeModel())->countAllResults();
        $totalUsers = (new UserModel())->countAllResults();
        $setting = (new SettingModel())->first();

        $warningLimit = (int) ($setting['warning_limit'] ?? 0);

        $waitingModel = new VisitModel();
        $visitingModel = new VisitModel();
        $completedModel = new VisitModel();
        $rejectedModel = new VisitModel();
        $cancelledModel = new VisitModel();

        if ($isFiltered) {

            $statusModels = [
                $waitingModel,
                $visitingModel,
                $completedModel,
                $rejectedModel,
                $cancelledModel,
            ];

            foreach ($statusModels as $model) {
                $model
                    ->where(
                        'arrival_time >=',
                        $periodStart . ' 00:00:00'
                    )
                    ->where(
                        'arrival_time <=',
                        $periodEnd . ' 23:59:59'
                    );
            }
        }

        $waiting = $waitingModel
            ->where('status', 'Menunggu')
            ->countAllResults();

        $visiting = $visitingModel
            ->where('status', 'Masih Berkunjung')
            ->countAllResults();

        $completed = $completedModel
            ->where('status', 'Selesai')
            ->countAllResults();

        $rejected = $rejectedModel
            ->where('status', 'Ditolak')
            ->countAllResults();

        $cancelled = $cancelledModel
            ->where('status', 'Dibatalkan')
            ->countAllResults();

        $notCheckedOutModel = new VisitModel();

        if ($isFiltered) {
            $notCheckedOutModel
                ->where(
                    'arrival_time >=',
                    $periodStart . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $periodEnd . ' 23:59:59'
                );
        }

        $notCheckedOut = $notCheckedOutModel
            ->where('status', 'Masih Berkunjung')
            ->countAllResults();

        $dailyVisitsModel = new VisitModel();

        $dailyVisitsModel
            ->select(
                "DATE(arrival_time) AS visit_date, COUNT(*) AS total_visits"
            );

        if ($isFiltered) {

            $dailyVisitsModel
                ->where(
                    'arrival_time >=',
                    $periodStart . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $periodEnd . ' 23:59:59'
                );
        } else {

            $dailyVisitsModel
                ->where(
                    'arrival_time >=',
                    date('Y-m-01 00:00:00')
                )
                ->where(
                    'arrival_time <=',
                    date('Y-m-t 23:59:59')
                );
        }

        $dailyVisits = $dailyVisitsModel
            ->groupBy('DATE(arrival_time)')
            ->orderBy('visit_date', 'ASC')
            ->findAll();

        $hourlyVisitsModel = new VisitModel();

        $hourlyVisitsModel
            ->select(
                "HOUR(arrival_time) AS visit_hour, COUNT(*) AS total_visits"
            );

        if ($isFiltered) {

            $hourlyVisitsModel
                ->where(
                    'arrival_time >=',
                    $periodStart . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $periodEnd . ' 23:59:59'
                );
        } else {

            $hourlyVisitsModel
                ->where(
                    'arrival_time >=',
                    date('Y-m-01 00:00:00')
                )
                ->where(
                    'arrival_time <=',
                    date('Y-m-t 23:59:59')
                );
        }
        $hourlyVisits = $hourlyVisitsModel
            ->groupBy('HOUR(arrival_time)')
            ->orderBy('visit_hour', 'ASC')
            ->findAll();

        $statusChart = [
            'Menunggu'        => $waiting,
            'Masih Berkunjung' => $visiting,
            'Selesai'         => $completed,
            'Ditolak'         => $rejected,
            'Dibatalkan'      => $cancelled,
            'Belum Check-out' => $notCheckedOut,
        ];

        $departmentVisitsModel = new VisitModel();

        $departmentVisitsModel
            ->select(
                'departments.name AS department_name, COUNT(visits.id) AS total_visits'
            )
            ->join(
                'departments',
                'departments.id = visits.department_id',
                'left'
            );

        if ($isFiltered) {

            $departmentVisitsModel
                ->where(
                    'visits.arrival_time >=',
                    $periodStart . ' 00:00:00'
                )
                ->where(
                    'visits.arrival_time <=',
                    $periodEnd . ' 23:59:59'
                );
        }

        $departmentVisits = $departmentVisitsModel
            ->groupBy('departments.id, departments.name')
            ->orderBy('total_visits', 'DESC')
            ->findAll(5);

        $employeeVisitsModel = new VisitModel();

        $employeeVisitsModel
            ->select(
                'employees.employee_name, COUNT(visits.id) AS total_visits'
            )
            ->join(
                'employees',
                'employees.id = visits.employee_id',
                'left'
            );

        if ($isFiltered) {

            $employeeVisitsModel
                ->where(
                    'visits.arrival_time >=',
                    $periodStart . ' 00:00:00'
                )
                ->where(
                    'visits.arrival_time <=',
                    $periodEnd . ' 23:59:59'
                );
        }

        $employeeVisits = $employeeVisitsModel
            ->groupBy('employees.id, employees.employee_name')
            ->orderBy('total_visits', 'DESC')
            ->findAll(5);

        $latestVisitsModel = new VisitModel();

        $latestVisitsModel
            ->select(
                'visits.visit_code,
        visits.arrival_time,
        visits.status,
        visits.group_size,
        guests.guest_name,
        departments.name AS department_name,
        employees.employee_name,
        visit_purposes.purpose_name'
            )
            ->join(
                'guests',
                'guests.id = visits.guest_id',
                'left'
            )
            ->join(
                'departments',
                'departments.id = visits.department_id',
                'left'
            )
            ->join(
                'employees',
                'employees.id = visits.employee_id',
                'left'
            )
            ->join(
                'visit_purposes',
                'visit_purposes.id = visits.purpose_id',
                'left'
            );

        if ($isFiltered) {

            $latestVisitsModel
                ->where(
                    'visits.arrival_time >=',
                    $periodStart . ' 00:00:00'
                )
                ->where(
                    'visits.arrival_time <=',
                    $periodEnd . ' 23:59:59'
                );
        }

        $latestVisits = $latestVisitsModel
            ->orderBy('visits.arrival_time', 'DESC')
            ->findAll(5);

        $tooLongVisits = [];

        if ($warningLimit > 0) {

            $tooLongVisitsModel = new VisitModel();

            $tooLongVisitsModel
                ->select(
                    'visits.visit_code,
            visits.arrival_time,
            visits.check_in,
            visits.status,
            guests.guest_name,
            departments.name AS department_name,
            employees.employee_name'
                )
                ->join(
                    'guests',
                    'guests.id = visits.guest_id',
                    'left'
                )
                ->join(
                    'departments',
                    'departments.id = visits.department_id',
                    'left'
                )
                ->join(
                    'employees',
                    'employees.id = visits.employee_id',
                    'left'
                )
                ->where(
                    'visits.status',
                    'Masih Berkunjung'
                )
                ->where(
                    'visits.check_in IS NOT NULL',
                    null,
                    false
                )
                ->where(
                    'TIMESTAMPDIFF(MINUTE, visits.check_in, NOW()) >=',
                    $warningLimit,
                    false
                );

            if ($isFiltered) {

                $tooLongVisitsModel
                    ->where(
                        'visits.arrival_time >=',
                        $periodStart . ' 00:00:00'
                    )
                    ->where(
                        'visits.arrival_time <=',
                        $periodEnd . ' 23:59:59'
                    );
            }

            $tooLongVisits = $tooLongVisitsModel
                ->orderBy(
                    'visits.check_in',
                    'ASC'
                )
                ->findAll(5);
        }

        return view('admin/dashboard/index', [
            'title'     => 'Dashboard',
            'pageTitle' => 'Dashboard',

            'isFiltered'      => $isFiltered,
            'filterStartDate' => $filterStartDate,
            'filterEndDate'   => $filterEndDate,
            'filterError'     => $filterError,

            'periodVisits' => $periodVisits,
            'periodGuests' => $periodGuests,

            'todayVisits' => $todayVisits,
            'todayGuests' => $todayGuests,

            'weekVisits' => $weekVisits,
            'weekGuests' => $weekGuests,

            'monthVisits' => $monthVisits,
            'monthGuests' => $monthGuests,

            'totalEmployees' => $totalEmployees,
            'totalDepartments' => $totalDepartments,
            'totalPurposes' => $totalPurposes,
            'totalUsers' => $totalUsers,

            'waiting' => $waiting,
            'visiting' => $visiting,
            'completed' => $completed,
            'rejected' => $rejected,
            'cancelled' => $cancelled,
            'notCheckedOut' => $notCheckedOut,

            'dailyVisits'  => $dailyVisits,
            'hourlyVisits' => $hourlyVisits,
            'statusChart'  => $statusChart,
            'departmentVisits' => $departmentVisits,
            'employeeVisits'  => $employeeVisits,

            'latestVisits' => $latestVisits,
            'tooLongVisits' => $tooLongVisits,
            'warningLimit' => $warningLimit,
        ]);
    }
}
