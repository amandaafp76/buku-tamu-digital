<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VisitModel;
use App\Models\SettingModel;

class PetugasDashboardController extends BaseController
{
    public function index(): string
    {
        $today = date('Y-m-d');

        $weekStart = date(
            'Y-m-d',
            strtotime('monday this week')
        );

        $weekEnd = date(
            'Y-m-d',
            strtotime('sunday this week')
        );

        $monthStart = date('Y-m-01');

        $monthEnd = date('Y-m-t');

        $filterStartDate = trim(
            (string) $this->request->getGet('start_date')
        );

        $filterEndDate = trim(
            (string) $this->request->getGet('end_date')
        );

        $isFiltered = (
            $filterStartDate !== '' ||
            $filterEndDate !== ''
        );

        $filterError = '';

        if ($isFiltered) {

            $start = \DateTime::createFromFormat(
                'Y-m-d',
                $filterStartDate
            );

            $end = \DateTime::createFromFormat(
                'Y-m-d',
                $filterEndDate
            );

            $validStart = (
                $start !== false &&
                $start->format('Y-m-d') === $filterStartDate
            );

            $validEnd = (
                $end !== false &&
                $end->format('Y-m-d') === $filterEndDate
            );

            if (
                ! $validStart ||
                ! $validEnd
            ) {

                $filterError =
                    'Silakan pilih tanggal mulai dan tanggal akhir yang valid.';

                $filterStartDate = '';
                $filterEndDate = '';
                $isFiltered = false;
            } elseif ($filterStartDate > $filterEndDate) {

                $filterError =
                    'Rentang tanggal tidak valid.';

                $filterStartDate = '';
                $filterEndDate = '';
                $isFiltered = false;
            }
        }

        if ($isFiltered) {

            $periodGuests = (new VisitModel())
                ->selectSum(
                    'group_size',
                    'total_guests'
                )
                ->where(
                    'arrival_time >=',
                    $filterStartDate . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $filterEndDate . ' 23:59:59'
                )
                ->get()
                ->getRow()
                ->total_guests ?? 0;

            $periodVisits = (new VisitModel())
                ->where(
                    'arrival_time >=',
                    $filterStartDate . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $filterEndDate . ' 23:59:59'
                )
                ->countAllResults();
        } else {

            $periodGuests = 0;
            $periodVisits = 0;
        }

        $todayGuests = (new VisitModel())
            ->selectSum(
                'group_size',
                'total_guests'
            )
            ->where(
                'DATE(arrival_time)',
                $today,
                false
            )
            ->get()
            ->getRow()
            ->total_guests ?? 0;


        $weekGuests = (new VisitModel())
            ->selectSum(
                'group_size',
                'total_guests'
            )
            ->where(
                'DATE(arrival_time) >=',
                $weekStart
            )
            ->where(
                'DATE(arrival_time) <=',
                $weekEnd
            )
            ->get()
            ->getRow()
            ->total_guests ?? 0;


        $monthGuests = (new VisitModel())
            ->selectSum(
                'group_size',
                'total_guests'
            )
            ->where(
                'DATE(arrival_time) >=',
                $monthStart
            )
            ->where(
                'DATE(arrival_time) <=',
                $monthEnd
            )
            ->get()
            ->getRow()
            ->total_guests ?? 0;


        $totalGuests = (new VisitModel())
            ->selectSum(
                'group_size',
                'total_guests'
            )
            ->get()
            ->getRow()
            ->total_guests ?? 0;


        $totalVisits = (new VisitModel())
            ->countAllResults();

        $waitingModel = new VisitModel();

        $visitingModel = new VisitModel();

        $completedModel = new VisitModel();

        $rejectedModel = new VisitModel();

        $cancelledModel = new VisitModel();

        $notCheckedOutModel = new VisitModel();


        if ($isFiltered) {

            $waitingModel
                ->where(
                    'arrival_time >=',
                    $filterStartDate . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $filterEndDate . ' 23:59:59'
                );

            $visitingModel
                ->where(
                    'arrival_time >=',
                    $filterStartDate . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $filterEndDate . ' 23:59:59'
                );

            $completedModel
                ->where(
                    'arrival_time >=',
                    $filterStartDate . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $filterEndDate . ' 23:59:59'
                );

            $rejectedModel
                ->where(
                    'arrival_time >=',
                    $filterStartDate . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $filterEndDate . ' 23:59:59'
                );

            $cancelledModel
                ->where(
                    'arrival_time >=',
                    $filterStartDate . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $filterEndDate . ' 23:59:59'
                );

            $notCheckedOutModel
                ->where(
                    'arrival_time >=',
                    $filterStartDate . ' 00:00:00'
                )
                ->where(
                    'arrival_time <=',
                    $filterEndDate . ' 23:59:59'
                );
        }

        $waiting = $waitingModel
            ->where(
                'status',
                'Menunggu'
            )
            ->countAllResults();


        $visiting = $visitingModel
            ->where(
                'status',
                'Masih Berkunjung'
            )
            ->countAllResults();


        $completed =  $completedModel
            ->where(
                'status',
                'Selesai'
            )
            ->countAllResults();


        $rejected = $rejectedModel
            ->where(
                'status',
                'Ditolak'
            )
            ->countAllResults();


        $cancelled = $cancelledModel
            ->where(
                'status',
                'Dibatalkan'
            )
            ->countAllResults();


        $notCheckedOut = $notCheckedOutModel
            ->where(
                'status',
                'Masih Berkunjung'
            )
            ->countAllResults();

        $chartStartDate = $isFiltered
            ? $filterStartDate
            : $monthStart;

        $chartEndDate = $isFiltered
            ? $filterEndDate
            : $monthEnd;

        $dailyVisits = (new VisitModel())
            ->select("
                DATE(arrival_time) AS visit_date,
                COUNT(*) AS total_visits
            ")
            ->where(
                'arrival_time >=',
                $chartStartDate . ' 00:00:00'
            )
            ->where(
                'arrival_time <=',
                $chartEndDate . ' 23:59:59'
            )
            ->groupBy(
                'DATE(arrival_time)'
            )
            ->orderBy(
                'visit_date',
                'ASC'
            )
            ->findAll();

        $hourlyVisits = (new VisitModel())
            ->select("
                HOUR(arrival_time) AS visit_hour,
                COUNT(*) AS total_visits
            ")
            ->where(
                'arrival_time >=',
                $chartStartDate . ' 00:00:00'
            )
            ->where(
                'arrival_time <=',
                $chartEndDate . ' 23:59:59'
            )
            ->groupBy(
                'HOUR(arrival_time)'
            )
            ->orderBy(
                'visit_hour',
                'ASC'
            )
            ->findAll();


        $departmentVisitsModel = (new VisitModel())
            ->select("
        departments.name AS department_name,
        COUNT(visits.id) AS total_visits
    ")
            ->join(
                'departments',
                'departments.id = visits.department_id',
                'left'
            );

        if ($isFiltered) {

            $departmentVisitsModel
                ->where(
                    'visits.arrival_time >=',
                    $filterStartDate . ' 00:00:00'
                )
                ->where(
                    'visits.arrival_time <=',
                    $filterEndDate . ' 23:59:59'
                );
        }

        $departmentVisits = $departmentVisitsModel
            ->groupBy(
                'departments.id, departments.name'
            )
            ->orderBy(
                'total_visits',
                'DESC'
            )
            ->findAll(5);

        $setting = (new SettingModel())->first();

        $warningLimit = (int) (
            $setting['warning_limit'] ?? 0
        );

        $latestVisitsModel = (new VisitModel())
            ->select("
                visits.id,
                visits.visit_code,
                visits.arrival_time,
                visits.check_in,
                visits.status,
                visits.group_size,
                guests.guest_name,
                departments.name AS department_name,
                employees.employee_name,
                visit_purposes.purpose_name
            ")
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
                    $filterStartDate . ' 00:00:00'
                )
                ->where(
                    'visits.arrival_time <=',
                    $filterEndDate . ' 23:59:59'
                );
        }


        $latestVisits = $latestVisitsModel
            ->orderBy(
                'visits.arrival_time',
                'DESC'
            )
            ->findAll(5);

        $tooLongVisits = [];

        if ($warningLimit > 0) {

            $tooLongVisits = (new VisitModel())
                ->select("
                    visits.id,
                    visits.visit_code,
                    visits.arrival_time,
                    visits.check_in,
                    visits.status,
                    visits.group_size,
                    guests.guest_name,
                    departments.name AS department_name,
                    employees.employee_name
                ")
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
                ->whereIn(
                    'visits.status',
                    [
                        'Masih Berkunjung',
                        'Belum Check-out'
                    ]
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
                )
                ->orderBy(
                    'visits.check_in',
                    'ASC'
                )
                ->findAll(5);
        }

        return view(
            'petugas/dashboard/index',
            [
                'title' => 'Dashboard Petugas',
                'pageTitle' => 'Dashboard Petugas',

                'todayGuests' => $todayGuests,
                'weekGuests' => $weekGuests,
                'monthGuests' => $monthGuests,

                'totalGuests' => $totalGuests,
                'totalVisits' => $totalVisits,

                'periodGuests' => $periodGuests,
                'periodVisits' => $periodVisits,

                'isFiltered' => $isFiltered,
                'filterStartDate' => $filterStartDate,
                'filterEndDate' => $filterEndDate,
                'filterError' => $filterError,

                'waiting' => $waiting,
                'visiting' => $visiting,
                'completed' => $completed,
                'rejected' => $rejected,
                'cancelled' => $cancelled,
                'notCheckedOut' => $notCheckedOut,

                'dailyVisits' => $dailyVisits,
                'hourlyVisits' => $hourlyVisits,
                'departmentVisits' => $departmentVisits,

                'latestVisits' => $latestVisits,

                'tooLongVisits' => $tooLongVisits,
                'warningLimit' => $warningLimit,
            ]
        );
    }
}
