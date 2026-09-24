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

        $weekStart = date('Y-m-d', strtotime('monday this week'));
        $weekEnd   = date('Y-m-d', strtotime('sunday this week'));

        $monthStart = date('Y-m-01');
        $monthEnd   = date('Y-m-t');

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

        $waiting = $visitModel
            ->where('status', 'Menunggu')
            ->countAllResults();

        $visiting = $visitModel
            ->where('status', 'Masih Berkunjung')
            ->countAllResults();

        $completed = $visitModel
            ->where('status', 'Selesai')
            ->countAllResults();

        $rejected = $visitModel
            ->where('status', 'Ditolak')
            ->countAllResults();

        $cancelled = $visitModel
            ->where('status', 'Dibatalkan')
            ->countAllResults();

        $notCheckedOut = $visitModel
            ->where('status', 'Belum Check-out')
            ->countAllResults();

        $dailyVisits = $visitModel
            ->select("DATE(arrival_time) AS visit_date, COUNT(*) AS total_visits")
            ->where('arrival_time >=', date('Y-m-01 00:00:00'))
            ->where('arrival_time <=', date('Y-m-t 23:59:59'))
            ->groupBy('DATE(arrival_time)')
            ->orderBy('visit_date', 'ASC')
            ->findAll();

        $hourlyVisits = $visitModel
            ->select("HOUR(arrival_time) AS visit_hour, COUNT(*) AS total_visits")
            ->where('arrival_time >=', date('Y-m-01 00:00:00'))
            ->where('arrival_time <=', date('Y-m-t 23:59:59'))
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

        $departmentVisits = $visitModel
            ->select('departments.name AS department_name, COUNT(visits.id) AS total_visits')
            ->join(
                'departments',
                'departments.id = visits.department_id',
                'left'
            )
            ->groupBy('departments.id, departments.name')
            ->orderBy('total_visits', 'DESC')
            ->findAll(5);

        $employeeVisits = $visitModel
            ->select('employees.employee_name, COUNT(visits.id) AS total_visits')
            ->join(
                'employees',
                'employees.id = visits.employee_id',
                'left'
            )
            ->groupBy('employees.id, employees.employee_name')
            ->orderBy('total_visits', 'DESC')
            ->findAll();

        $latestVisits = (new VisitModel())
            ->select('visits.visit_code, visits.arrival_time, visits.status, visits.group_size, guests.guest_name, departments.name AS department_name, employees.employee_name, visit_purposes.purpose_name')
            ->join('guests', 'guests.id = visits.guest_id', 'left')
            ->join('departments', 'departments.id = visits.department_id', 'left')
            ->join('employees', 'employees.id = visits.employee_id', 'left')
            ->join('visit_purposes', 'visit_purposes.id = visits.purpose_id', 'left')
            ->orderBy('visits.arrival_time', 'DESC')
            ->findAll(5);

        $tooLongVisits = [];

        if ($warningLimit > 0) {

            $tooLongVisits = (new VisitModel())
                ->select('visits.visit_code, visits.arrival_time, visits.check_in, visits.status, guests.guest_name, departments.name AS department_name, employees.employee_name')
                ->join('guests', 'guests.id = visits.guest_id', 'left')
                ->join('departments', 'departments.id = visits.department_id', 'left')
                ->join('employees', 'employees.id = visits.employee_id', 'left')
                ->whereIn('visits.status', ['Masih Berkunjung', 'Belum Check-out'])
                ->where('visits.check_in IS NOT NULL', null, false)
                ->where(
                    'TIMESTAMPDIFF(MINUTE, visits.check_in, NOW()) >=',
                    $warningLimit,
                    false
                )
                ->orderBy('visits.check_in', 'ASC')
                ->findAll(5);
        }

        return view('admin/dashboard/index', [
            'title'     => 'Dashboard',
            'pageTitle' => 'Dashboard',

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
