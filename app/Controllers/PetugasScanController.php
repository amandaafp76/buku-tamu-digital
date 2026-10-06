<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VisitModel;

class PetugasScanController extends BaseController
{
    public function index()
    {
        return view('petugas/scan/index');
    }

    public function findByQr()
    {
        $qrToken = trim((string) $this->request->getPost('qr_token'));

        if ($qrToken === '') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'QR Code tidak valid.',
            ]);
        }

        $visitModel = new VisitModel();

        $visit = $visitModel
            ->select('
            visits.id,
            visits.visit_code,
            visits.status,
            visits.arrival_time,
            visits.check_in,
            visits.check_out,
            visits.duration,
            guests.guest_name,
            guests.phone,
            guests.institution,
            departments.name AS department_name,
            employees.employee_name,
            visit_purposes.purpose_name
        ')
            ->join('guests', 'guests.id = visits.guest_id')
            ->join('departments', 'departments.id = visits.department_id')
            ->join('employees', 'employees.id = visits.employee_id')
            ->join('visit_purposes', 'visit_purposes.id = visits.purpose_id')
            ->where('visits.qr_token', $qrToken)
            ->first();

        if (! $visit) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data kunjungan tidak ditemukan.',
            ]);
        }

        if ($visit['status'] !== 'Masih Berkunjung') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'QR Code tidak dapat digunakan untuk check-out. Status kunjungan saat ini: ' . $visit['status'],
            ]);
        }

        return $this->response->setJSON([
            'success'  => true,
            'message'  => 'Data kunjungan ditemukan.',
            'visit'    => $visit,
            'csrfHash' => csrf_hash(),
        ]);
    }

    public function checkOut()
    {
        $visitId = (int) $this->request->getPost('visit_id');

        if ($visitId <= 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data kunjungan tidak valid.',
            ]);
        }

        $visitModel = new VisitModel();

        $visit = $visitModel
            ->where('id', $visitId)
            ->first();

        if (! $visit) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data kunjungan tidak ditemukan.',
            ]);
        }

        if ($visit['status'] !== 'Masih Berkunjung') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kunjungan tidak dapat di-check-out karena status saat ini: ' . $visit['status'],
            ]);
        }

        if (empty($visit['check_in'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data check-in tidak ditemukan.',
            ]);
        }

        $checkOutTime = date('Y-m-d H:i:s');

        $checkIn = new \DateTime($visit['check_in']);
        $checkOut = new \DateTime($checkOutTime);

        $duration = (int) floor(
            ($checkOut->getTimestamp() - $checkIn->getTimestamp()) / 60
        );

        $duration = max(0, $duration);

        $visitModel->update($visitId, [
            'status'    => 'Selesai',
            'check_out' => $checkOutTime,
            'duration'  => $duration,
        ]);

        return $this->response->setJSON([
            'success'  => true,
            'message'  => 'Kunjungan berhasil di-check-out.',
            'csrfHash' => csrf_hash(),
            'visit'    => [
                'visit_code' => $visit['visit_code'],
                'check_out'  => $checkOutTime,
                'duration'   => $duration,
            ],
        ]);
    }
}
