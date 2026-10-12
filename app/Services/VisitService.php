<?php

namespace App\Services;

use App\Models\VisitModel;

class VisitService
{
    protected VisitModel $visitModel;

    public function __construct()
    {
        $this->visitModel = new VisitModel();
    }

    public function getVisits(
        string $keyword = '',
        $status = '',
        string $date = '',
        bool $showDeleted = false
    ) {
        $visitModel = $this->visitModel;

        $visitModel
            ->select('
                visits.*,
                guests.guest_name,
                guests.phone,
                departments.name AS department_name,
                employees.employee_name,
                visit_purposes.purpose_name
            ')
            ->join(
                'guests',
                'guests.id = visits.guest_id'
            )
            ->join(
                'departments',
                'departments.id = visits.department_id'
            )
            ->join(
                'employees',
                'employees.id = visits.employee_id'
            )
            ->join(
                'visit_purposes',
                'visit_purposes.id = visits.purpose_id'
            );

        if ($keyword !== '') {
            $visitModel
                ->groupStart()
                ->like('guests.guest_name', $keyword)
                ->orLike('visits.visit_code', $keyword)
                ->orLike('guests.phone', $keyword)
                ->orLike('departments.name', $keyword)
                ->orLike('employees.employee_name', $keyword)
                ->groupEnd();
        }

        if (is_array($status) && ! empty($status)) {
            $visitModel->whereIn('visits.status', $status);
        } elseif (is_string($status) && $status !== '') {
            $visitModel->where('visits.status', $status);
        }

        if ($date !== '') {
            $visitModel->where(
                'DATE(visits.arrival_time)',
                $date
            );
        }

        if ($showDeleted) {
            $visitModel->onlyDeleted();
        }

        $visits = $visitModel
            ->orderBy(
                'visits.created_at',
                'DESC'
            )
            ->paginate(10);

        return [
            'visits' => $visits,
            'pager'  => $visitModel->pager,
        ];
    }

    public function getVisitDetail(int $id): ?array
    {
        $visitModel = $this->visitModel;

        return $visitModel
            ->select('
                visits.*,
                guests.guest_name,
                guests.phone,
                guests.address,
                guests.institution,
                departments.name AS department_name,
                employees.employee_name,
                visit_purposes.purpose_name
            ')
            ->join(
                'guests',
                'guests.id = visits.guest_id'
            )
            ->join(
                'departments',
                'departments.id = visits.department_id'
            )
            ->join(
                'employees',
                'employees.id = visits.employee_id'
            )
            ->join(
                'visit_purposes',
                'visit_purposes.id = visits.purpose_id'
            )
            ->where(
                'visits.id',
                $id
            )
            ->first();
    }

    public function find(int $id): ?array
    {
        return $this->visitModel->find($id);
    }

    public function getReportData(array $filters): array
    {
        $visitModel = new VisitModel();

        $visitModel
            ->select('
            visits.*,
            guests.guest_name,
            guests.phone,
            guests.institution,
            departments.name AS department_name,
            employees.employee_name,
            visit_purposes.purpose_name
        ')
            ->join(
                'guests',
                'guests.id = visits.guest_id'
            )
            ->join(
                'departments',
                'departments.id = visits.department_id'
            )
            ->join(
                'employees',
                'employees.id = visits.employee_id'
            )
            ->join(
                'visit_purposes',
                'visit_purposes.id = visits.purpose_id'
            );

        if (
            ! empty($filters['start_date']) &&
            ! empty($filters['end_date'])
        ) {
            $visitModel
                ->where(
                    'visits.arrival_time >=',
                    $filters['start_date'] . ' 00:00:00'
                )
                ->where(
                    'visits.arrival_time <=',
                    $filters['end_date'] . ' 23:59:59'
                );
        }

        if (! empty($filters['department_id'])) {
            $visitModel->where(
                'visits.department_id',
                (int) $filters['department_id']
            );
        }

        if (! empty($filters['employee_id'])) {
            $visitModel->where(
                'visits.employee_id',
                (int) $filters['employee_id']
            );
        }

        if (! empty($filters['institution'])) {
            $visitModel->like(
                'guests.institution',
                $filters['institution']
            );
        }

        if (! empty($filters['status'])) {
            $visitModel->where(
                'visits.status',
                $filters['status']
            );
        }

        return $visitModel
            ->orderBy(
                'visits.arrival_time',
                'DESC'
            )
            ->findAll();
    }

    public function getReportSummary(array $reportData): array
    {
        $totalVisits = count($reportData);

        $totalDuration = 0;

        foreach ($reportData as $visit) {
            $totalDuration += $this->calculateDuration($visit);
        }

        $averageDuration = $totalVisits > 0
            ? (int) floor(
                $totalDuration / $totalVisits
            )
            : 0;

        return [
            'total_visits'     => $totalVisits,
            'total_duration'   => $totalDuration,
            'average_duration' => $averageDuration,
        ];
    }

    protected function calculateDuration(array $visit): int
    {
        if (
            isset($visit['duration']) &&
            $visit['duration'] !== null &&
            $visit['duration'] !== ''
        ) {
            return (int) $visit['duration'];
        }

        if (
            ($visit['status'] ?? '') === 'Masih Berkunjung' &&
            ! empty($visit['check_in'])
        ) {
            $checkIn = strtotime($visit['check_in']);

            if ($checkIn !== false) {
                $diff = time() - $checkIn;

                return max(0, (int) floor($diff / 60));
            }
        }

        return 0;
    }

    public function getReportGrouping(array $reportData): array
    {
        $byDepartment  = [];
        $byEmployee    = [];
        $byInstitution = [];

        foreach ($reportData as $visit) {
            $duration = $this->calculateDuration($visit);

            $deptName = $visit['department_name'] ?: '-';

            if (! isset($byDepartment[$deptName])) {
                $byDepartment[$deptName] = [
                    'department_name' => $deptName,
                    'total_visits'    => 0,
                    'total_duration'  => 0,
                ];
            }

            $byDepartment[$deptName]['total_visits']   += 1;
            $byDepartment[$deptName]['total_duration'] += $duration;

            $empName = $visit['employee_name'] ?: '-';

            if (! isset($byEmployee[$empName])) {
                $byEmployee[$empName] = [
                    'employee_name'   => $empName,
                    'department_name' => $visit['department_name'] ?: '-',
                    'total_visits'    => 0,
                    'total_duration'  => 0,
                ];
            }

            $byEmployee[$empName]['total_visits']   += 1;
            $byEmployee[$empName]['total_duration'] += $duration;

            $institution = trim((string) ($visit['institution'] ?? ''));

            if ($institution !== '') {
                if (! isset($byInstitution[$institution])) {
                    $byInstitution[$institution] = [
                        'institution'    => $institution,
                        'total_visits'   => 0,
                        'total_duration' => 0,
                    ];
                }

                $byInstitution[$institution]['total_visits']   += 1;
                $byInstitution[$institution]['total_duration'] += $duration;
            }
        }

        $byDepartment  = $this->sortAndAverage($byDepartment);
        $byEmployee    = $this->sortAndAverage($byEmployee);
        $byInstitution = $this->sortAndAverage($byInstitution);

        return [
            'by_department'  => array_values($byDepartment),
            'by_employee'    => array_values($byEmployee),
            'by_institution' => array_values($byInstitution),
        ];
    }

    protected function sortAndAverage(array $grouping): array
    {
        foreach ($grouping as $key => $item) {
            $grouping[$key]['average_duration'] =
                $item['total_visits'] > 0
                ? (int) floor($item['total_duration'] / $item['total_visits'])
                : 0;
        }

        usort($grouping, function ($a, $b) {
            return $b['total_visits'] <=> $a['total_visits'];
        });

        return $grouping;
    }
}
