<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Services\VisitService;
use App\Services\ReportExportService;
use App\Models\InstitutionModel;

class ReportController extends BaseController
{
    protected VisitService $visitService;
    protected ReportExportService $exportService;

    public function __construct()
    {
        $this->visitService  = new VisitService();
        $this->exportService = new ReportExportService();
    }

    public function index()
    {
        $filters = $this->buildFilters();

        $reportData    = $this->visitService->getReportData($filters);
        $reportSummary = $this->visitService->getReportSummary($reportData);
        $reportGrouping = $this->visitService->getReportGrouping($reportData);

        $departments = (new DepartmentModel())
            ->where('active', 1)
            ->orderBy('name', 'ASC')
            ->findAll();

        $employees = (new EmployeeModel())
            ->where('active', 1)
            ->orderBy('employee_name', 'ASC')
            ->findAll();

        return view('admin/laporan/index', [
            'title'       => 'Laporan',
            'pageTitle'   => 'Laporan',
            'departments' => $departments,
            'employees'   => $employees,
            'filters'     => $filters,
            'reportData'  => $reportData,
            'reportSummary' => $reportSummary,
            'reportGrouping' => $reportGrouping,
        ]);
    }

    public function pdf()
    {
        $filters = $this->buildFilters();
        $reportData    = $this->visitService->getReportData($filters);
        $reportSummary = $this->visitService->getReportSummary($reportData);
        $reportGrouping = $this->visitService->getReportGrouping($reportData);

        $primaryColor = $this->settings['primary_color'] ?? '#9A3F3F';

        $institution = null;

        if (! empty($this->settings['institution_id'])) {
            $institution = (new \App\Models\InstitutionModel())
                ->find((int) $this->settings['institution_id']);
        }

        $pdf = $this->exportService->generatePdf(
            $filters,
            $reportData,
            $reportSummary,
            $reportGrouping,
            $primaryColor,
            $institution
        );

        $filename = 'laporan-buku-tamu-' . date('Ymd-His') . '.pdf';

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader(
                'Content-Disposition',
                'attachment; filename="' . $filename . '"'
            )
            ->setBody($pdf);
    }

    public function excel()
    {
        $filters = $this->buildFilters();
        $reportData    = $this->visitService->getReportData($filters);
        $reportSummary = $this->visitService->getReportSummary($reportData);
        $reportGrouping = $this->visitService->getReportGrouping($reportData);

        $primaryColor = $this->settings['primary_color'] ?? '#9A3F3F';

        $spreadsheet = $this->exportService->generateExcel(
            $filters,
            $reportData,
            $reportSummary,
            $reportGrouping,
            $primaryColor
        );

        $filename = 'laporan-buku-tamu-' . date('Ymd-His') . '.xlsx';

        if (ob_get_length()) {
            ob_end_clean();
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    protected function buildFilters(): array
    {
        $period = trim((string) $this->request->getGet('period'));
        $period = $period !== '' ? $period : 'monthly';

        $filters = [
            'period'        => $period,
            'month'         => trim((string) $this->request->getGet('month')),
            'date'          => trim((string) $this->request->getGet('date')),
            'week_start'    => trim((string) $this->request->getGet('week_start')),
            'start_date'    => trim((string) $this->request->getGet('start_date')),
            'end_date'      => trim((string) $this->request->getGet('end_date')),
            'department_id' => trim((string) $this->request->getGet('department_id')),
            'employee_id'   => trim((string) $this->request->getGet('employee_id')),
            'institution'   => trim((string) $this->request->getGet('institution')),
            'status'        => trim((string) $this->request->getGet('status')),
        ];

        if ($period === 'daily') {
            $filters['start_date'] = $filters['date'] !== ''
                ? $filters['date']
                : date('Y-m-d');
            $filters['end_date'] = $filters['start_date'];
        } elseif ($period === 'weekly') {
            $weekStart = $filters['week_start'] !== ''
                ? $filters['week_start']
                : date('Y-m-d', strtotime('monday this week'));
            $filters['start_date'] = $weekStart;
            $filters['end_date']   = date('Y-m-d', strtotime($weekStart . ' +6 days'));
        } elseif ($period === 'monthly') {
            $month = $filters['month'] !== ''
                ? $filters['month']
                : date('Y-m');
            $filters['start_date'] = $month . '-01';
            $filters['end_date']   = date('Y-m-t', strtotime($filters['start_date']));
        } elseif ($period === 'range') {
            $filters['start_date'] = $filters['start_date'] !== ''
                ? $filters['start_date']
                : date('Y-m-d');
            $filters['end_date'] = $filters['end_date'] !== ''
                ? $filters['end_date']
                : $filters['start_date'];
        }

        return $filters;
    }
}
