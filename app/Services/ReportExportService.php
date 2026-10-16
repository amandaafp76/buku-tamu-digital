<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class ReportExportService
{
    public function generatePdf(
        array $filters,
        array $reportData,
        array $reportSummary,
        array $reportGrouping,
        string $primaryColor = '#9A3F3F',
        ?array $institution = null
    ): string {
        $options = new Options();
        $options->set('isRemoteEnabled', false);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');

        $dompdf = new Dompdf($options);

        $logoBase64 = null;

        if (! empty($institution['logo'])) {
            $logoFile = $institution['logo'];

            if (str_contains($logoFile, '/')) {
                $logoPath = FCPATH . ltrim($logoFile, '/');
            } else {
                $logoPath = FCPATH . 'uploads/institusi/' . $logoFile;
            }

            if (is_file($logoPath)) {
                $mime = mime_content_type($logoPath) ?: 'image/png';
                $logoBase64 = 'data:' . $mime . ';base64,' .
                    base64_encode(file_get_contents($logoPath));
            }
        }

        $html = view('admin/laporan/pdf', [
            'filters'       => $filters,
            'reportData'    => $reportData,
            'reportSummary' => $reportSummary,
            'reportGrouping' => $reportGrouping,
            'printedAt'     => date('d-m-Y H:i:s'),
            'primaryColor'  => $primaryColor,
            'institution'   => $institution,
            'logoBase64'    => $logoBase64,
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $dompdf->output();
    }

    public function generateExcel(
        array $filters,
        array $reportData,
        array $reportSummary,
        array $reportGrouping,
        string $primaryColor = '#9A3F3F'
    ): Spreadsheet {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Kunjungan');

        $sheet->mergeCells('A1:I1');
        $sheet->setCellValue('A1', 'LAPORAN BUKU TAMU DIGITAL');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->mergeCells('A2:I2');
        $sheet->setCellValue(
            'A2',
            'Periode: ' . $this->formatPeriodLabel($filters)
        );
        $sheet->getStyle('A2')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->setCellValue('A4', 'Total Kunjungan');
        $sheet->setCellValue('C4', $reportSummary['total_visits']);

        $sheet->setCellValue('A5', 'Total Durasi (menit)');
        $sheet->setCellValue('C5', $reportSummary['total_duration']);

        $sheet->setCellValue('A6', 'Rata-rata Durasi (menit)');
        $sheet->setCellValue('C6', $reportSummary['average_duration']);

        $sheet->getStyle('A4:A6')->getFont()->setBold(true);

        $headerRow = 8;
        $headers = [
            'A' => 'No',
            'B' => 'Kode Kunjungan',
            'C' => 'Nama Tamu',
            'D' => 'Asal Instansi',
            'E' => 'Bagian',
            'F' => 'Pegawai',
            'G' => 'Keperluan',
            'H' => 'Waktu Kedatangan',
            'I' => 'Status',
        ];

        foreach ($headers as $col => $label) {
            $sheet->setCellValue($col . $headerRow, $label);
        }

        $headerStyle = [
            'font' => [
                'bold'  => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => ltrim($primaryColor, '#')],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ];

        $sheet->getStyle('A' . $headerRow . ':I' . $headerRow)
            ->applyFromArray($headerStyle);

        $row = $headerRow + 1;

        foreach ($reportData as $i => $visit) {
            $sheet->setCellValue('A' . $row, $i + 1);
            $sheet->setCellValue('B' . $row, $visit['visit_code'] ?? '-');
            $sheet->setCellValue('C' . $row, $visit['guest_name'] ?? '-');
            $sheet->setCellValue('D' . $row, $visit['institution'] ?: '-');
            $sheet->setCellValue('E' . $row, $visit['department_name'] ?: '-');
            $sheet->setCellValue('F' . $row, $visit['employee_name'] ?: '-');
            $sheet->setCellValue('G' . $row, $visit['purpose_name'] ?: '-');
            $sheet->setCellValue('H' . $row, $visit['arrival_time'] ?? '-');
            $sheet->setCellValue('I' . $row, $visit['status'] ?? '-');
            $row++;
        }

        if (! empty($reportData)) {
            $sheet->getStyle('A' . $headerRow . ':I' . ($row - 1))
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);
        }

        foreach (array_keys($headers) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $row += 3;

        $sheet->setCellValue('A' . $row, 'REKAP LAPORAN');
        $sheet->getStyle('A' . $row)
            ->getFont()->setBold(true)->setSize(14);
        $row += 2;

        $row = $this->writeRekapTable(
            $sheet,
            $row,
            'Rekap per Bagian / Departemen',
            [
                'No'                  => 5,
                'Bagian / Departemen' => 30,
                'Jumlah Kunjungan'    => 18,
                'Total Durasi'        => 22,
                'Rata-rata Durasi'    => 22,
            ],
            $reportGrouping['by_department'],
            [
                'name_key' => 'department_name',
                'show_avg' => true,
            ],
            $primaryColor
        );

        $row += 2;

        $row = $this->writeRekapTable(
            $sheet,
            $row,
            'Rekap per Pegawai',
            [
                'No'                  => 5,
                'Pegawai'             => 25,
                'Bagian / Departemen' => 25,
                'Jumlah Kunjungan'    => 18,
                'Total Durasi'        => 22,
            ],
            $reportGrouping['by_employee'],
            [
                'name_key'  => 'employee_name',
                'extra_key' => 'department_name',
                'show_avg'  => false,
            ],
            $primaryColor
        );

        $row += 2;

        $row = $this->writeRekapTable(
            $sheet,
            $row,
            'Rekap per Asal Instansi',
            [
                'No'               => 5,
                'Asal Instansi'    => 35,
                'Jumlah Kunjungan' => 18,
                'Total Durasi'     => 25,
            ],
            $reportGrouping['by_institution'],
            [
                'name_key' => 'institution',
                'show_avg' => false,
            ],
            $primaryColor
        );

        return $spreadsheet;
    }

    protected function writeRekapTable(
        $sheet,
        int $startRow,
        string $title,
        array $columns,
        array $rows,
        array $options = [],
        string $primaryColor = '#9A3F3F'
    ): int {

        $sheet->setCellValue('A' . $startRow, $title);
        $sheet->getStyle('A' . $startRow)
            ->getFont()->setBold(true)->setSize(12);
        $startRow++;

        $colIndex = 0;
        $colLetters = [];
        foreach ($columns as $label => $width) {
            $letter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($colIndex + 1);
            $colLetters[$label] = $letter;
            $sheet->setCellValue($letter . $startRow, $label);
            $sheet->getColumnDimension($letter)->setWidth($width);
            $colIndex++;
        }

        $headerStyle = [
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => ltrim($primaryColor, '#')],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ];

        $lastColLetter = $colLetters[array_key_last($colLetters)];
        $sheet->getStyle('A' . $startRow . ':' . $lastColLetter . $startRow)
            ->applyFromArray($headerStyle);

        $headerRow = $startRow;
        $startRow++;

        $nameKey  = $options['name_key']  ?? 'name';
        $extraKey = $options['extra_key'] ?? null;
        $showAvg  = $options['show_avg']  ?? false;

        foreach ($rows as $i => $row) {
            $colIndex = 0;
            $colArr = array_keys($columns);

            $sheet->setCellValue(
                $colLetters[$colArr[$colIndex]] . $startRow,
                $i + 1
            );
            $colIndex++;

            $sheet->setCellValue(
                $colLetters[$colArr[$colIndex]] . $startRow,
                $row[$nameKey] ?? '-'
            );
            $colIndex++;

            if ($extraKey !== null) {
                $sheet->setCellValue(
                    $colLetters[$colArr[$colIndex]] . $startRow,
                    $row[$extraKey] ?? '-'
                );
                $colIndex++;
            }

            $sheet->setCellValue(
                $colLetters[$colArr[$colIndex]] . $startRow,
                $row['total_visits'] ?? 0
            );
            $colIndex++;

            $durasiText = (int) floor(($row['total_duration'] ?? 0) / 60)
                . ' jam '
                . (($row['total_duration'] ?? 0) % 60)
                . ' menit';
            $sheet->setCellValue(
                $colLetters[$colArr[$colIndex]] . $startRow,
                $durasiText
            );
            $colIndex++;

            if ($showAvg) {
                $avgText = (int) floor(($row['average_duration'] ?? 0) / 60)
                    . ' jam '
                    . (($row['average_duration'] ?? 0) % 60)
                    . ' menit';
                $sheet->setCellValue(
                    $colLetters[$colArr[$colIndex]] . $startRow,
                    $avgText
                );
            }

            $startRow++;
        }

        if (! empty($rows)) {
            $sheet->getStyle('A' . $headerRow . ':' . $lastColLetter . ($startRow - 1))
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);
        }

        return $startRow;
    }

    protected function formatPeriodLabel(array $filters): string
    {
        $start = $filters['start_date'] ?? '-';
        $end   = $filters['end_date']   ?? '-';

        switch ($filters['period'] ?? 'monthly') {
            case 'daily':
                return 'Harian - ' . $start;
            case 'weekly':
                return 'Mingguan - ' . $start . ' s/d ' . $end;
            case 'monthly':
                return 'Bulanan - ' . $start . ' s/d ' . $end;
            case 'range':
                return 'Rentang - ' . $start . ' s/d ' . $end;
            default:
                return '-';
        }
    }
}
