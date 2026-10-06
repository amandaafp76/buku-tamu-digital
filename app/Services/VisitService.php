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
        string $status = '',
        string $date = ''
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

        if ($status !== '') {
            $visitModel->where(
                'visits.status',
                $status
            );
        }

        if ($date !== '') {
            $visitModel->where(
                'DATE(visits.arrival_time)',
                $date
            );
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
}
