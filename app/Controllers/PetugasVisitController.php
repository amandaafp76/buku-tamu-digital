<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VisitModel;
use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\VisitPurposeModel;
use App\Services\VisitService;

class PetugasVisitController extends BaseController
{
    protected VisitService $visitService;

    public function __construct()
    {
        $this->visitService = new VisitService();
    }

    public function index()
    {
        $keyword = trim(
            (string) $this->request->getGet('keyword')
        );

        $status = trim(
            (string) $this->request->getGet('status')
        );

        $date = trim(
            (string) $this->request->getGet('date')
        );

        $result = $this->visitService->getVisits(
            $keyword,
            $status,
            $date
        );

        return view('petugas/kunjungan/index', [
            'visits'  => $result['visits'],
            'pager'   => $result['pager'],
            'keyword' => $keyword,
            'status'  => $status,
            'date'    => $date,
        ]);
    }

    public function detail(int $id)
    {
        $visit = $this->visitService->getVisitDetail($id);

        if (! $visit) {
            return redirect()
                ->to(
                    site_url(
                        'petugas/bukutamu-kunjungan'
                    )
                )
                ->with(
                    'error',
                    'Data kunjungan tidak ditemukan.'
                );
        }

        return view(
            'petugas/kunjungan/detail',
            [
                'visit' => $visit,
            ]
        );
    }

    public function edit(int $id)
    {
        $visit = $this->visitService->getVisitDetail($id);

        if (! $visit) {
            return redirect()
                ->to(site_url('petugas/bukutamu-kunjungan'))
                ->with(
                    'error',
                    'Data kunjungan tidak ditemukan.'
                );
        }

        if ($visit['status'] !== 'Menunggu') {
            return redirect()
                ->to(
                    site_url(
                        'petugas/bukutamu-kunjungan/detail/' . $id
                    )
                )
                ->with(
                    'error',
                    'Data kunjungan hanya dapat diperbaiki saat status masih Menunggu.'
                );
        }

        $departmentModel = new DepartmentModel();
        $employeeModel   = new EmployeeModel();
        $purposeModel    = new VisitPurposeModel();

        $departments = $departmentModel
            ->where('active', 1)
            ->orderBy('name', 'ASC')
            ->findAll();

        $employees = $employeeModel
            ->where('active', 1)
            ->orderBy('employee_name', 'ASC')
            ->findAll();

        $purposes = $purposeModel
            ->where('active', 1)
            ->orderBy('purpose_name', 'ASC')
            ->findAll();

        return view('petugas/kunjungan/edit', [
            'visit'       => $visit,
            'departments' => $departments,
            'employees'   => $employees,
            'purposes'    => $purposes,
        ]);
    }

    public function update(int $id)
    {
        $visitModel = new VisitModel();

        $visit = $this->visitService->find($id);

        if (! $visit) {
            return redirect()
                ->to(site_url('petugas/bukutamu-kunjungan'))
                ->with(
                    'error',
                    'Data kunjungan tidak ditemukan.'
                );
        }

        if ($visit['status'] !== 'Menunggu') {
            return redirect()
                ->to(
                    site_url(
                        'petugas/bukutamu-kunjungan/detail/' . $id
                    )
                )
                ->with(
                    'error',
                    'Data kunjungan hanya dapat diperbaiki saat status masih Menunggu.'
                );
        }

        $rules = [
            'department_id' => [
                'label' => 'Bagian/Departemen',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'is_natural_no_zero' => '{field} tidak valid.',
                ],
            ],

            'employee_id' => [
                'label' => 'Pegawai Tujuan',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'is_natural_no_zero' => '{field} tidak valid.',
                ],
            ],

            'purpose_id' => [
                'label' => 'Keperluan Kunjungan',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'is_natural_no_zero' => '{field} tidak valid.',
                ],
            ],

            'group_size' => [
                'label' => 'Jumlah Rombongan',
                'rules' => 'required|is_natural_no_zero|less_than_equal_to[100]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'is_natural_no_zero' => '{field} harus berupa angka lebih dari 0.',
                    'less_than_equal_to' => '{field} maksimal 100 orang.',
                ],
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }

        $departmentModel = new DepartmentModel();
        $employeeModel   = new EmployeeModel();
        $purposeModel    = new VisitPurposeModel();

        $departmentId = (int) $this->request->getPost(
            'department_id'
        );

        $employeeId = (int) $this->request->getPost(
            'employee_id'
        );

        $purposeId = (int) $this->request->getPost(
            'purpose_id'
        );

        $department = $departmentModel
            ->where('id', $departmentId)
            ->where('active', 1)
            ->first();

        if (! $department) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Bagian/Departemen yang dipilih tidak valid.'
                );
        }

        $employee = $employeeModel
            ->where('id', $employeeId)
            ->where('department_id', $departmentId)
            ->where('active', 1)
            ->first();

        if (! $employee) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Pegawai tujuan tidak valid atau tidak sesuai dengan Bagian/Departemen.'
                );
        }

        $purpose = $purposeModel
            ->where('id', $purposeId)
            ->where('active', 1)
            ->first();

        if (! $purpose) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Keperluan kunjungan yang dipilih tidak valid.'
                );
        }

        $visitModel->update($id, [
            'department_id' => $departmentId,
            'employee_id'   => $employeeId,
            'purpose_id'    => $purposeId,
            'group_size'    => (int) $this->request->getPost(
                'group_size'
            ),
        ]);

        return redirect()
            ->to(
                site_url(
                    'petugas/bukutamu-kunjungan/detail/' . $id
                )
            )
            ->with(
                'success',
                'Data kunjungan berhasil diperbaiki.'
            );
    }

    public function verifyAndCheckIn(int $id)
    {
        $visitModel = new VisitModel();

        $visit = $this->visitService->find($id);

        if (! $visit) {
            return redirect()
                ->to(site_url('petugas/bukutamu-kunjungan'))
                ->with('error', 'Data kunjungan tidak ditemukan.');
        }

        if ($visit['status'] !== 'Menunggu') {
            return redirect()
                ->back()
                ->with('error', 'Kunjungan ini sudah diproses.');
        }

        $visitModel->update($id, [
            'status'   => 'Masih Berkunjung',
            'check_in' => date('Y-m-d H:i:s'),
        ]);

        return redirect()
            ->to(site_url('petugas/bukutamu-kunjungan/detail/' . $id))
            ->with('success', 'Kunjungan berhasil diverifikasi dan di-check-in.');
    }

    public function reject(int $id)
    {
        $visitModel = new VisitModel();

        $visit = $this->visitService->find($id);

        if (! $visit) {
            return redirect()
                ->to(site_url('petugas/bukutamu-kunjungan'))
                ->with('error', 'Data kunjungan tidak ditemukan.');
        }

        if ($visit['status'] !== 'Menunggu') {
            return redirect()
                ->back()
                ->with('error', 'Kunjungan ini sudah diproses.');
        }

        $visitModel->update($id, [
            'status' => 'Ditolak',
        ]);

        return redirect()
            ->to(site_url('petugas/bukutamu-kunjungan/detail/' . $id))
            ->with('success', 'Kunjungan berhasil ditolak.');
    }

    public function cancel(int $id)
    {
        $visitModel = new VisitModel();

        $visit = $this->visitService->find($id);

        if (! $visit) {
            return redirect()
                ->to(site_url('petugas/bukutamu-kunjungan'))
                ->with('error', 'Data kunjungan tidak ditemukan.');
        }

        if ($visit['status'] !== 'Menunggu') {
            return redirect()
                ->back()
                ->with('error', 'Kunjungan ini sudah diproses.');
        }

        $visitModel->update($id, [
            'status' => 'Dibatalkan',
        ]);

        return redirect()
            ->to(site_url('petugas/bukutamu-kunjungan/detail/' . $id))
            ->with('success', 'Kunjungan berhasil dibatalkan.');
    }

    public function checkOutManual(int $id)
    {
        $visitModel = new VisitModel();

        $visit = $this->visitService->find($id);

        if (! $visit) {
            return redirect()
                ->to(site_url('petugas/bukutamu-kunjungan'))
                ->with('error', 'Data kunjungan tidak ditemukan.');
        }

        if ($visit['status'] !== 'Masih Berkunjung') {
            return redirect()
                ->back()
                ->with('error', 'Kunjungan tidak dapat di-check-out karena status saat ini: ' . $visit['status']);
        }

        if (empty($visit['check_in'])) {
            return redirect()
                ->back()
                ->with('error', 'Data check-in tidak ditemukan.');
        }

        $checkOutTime = date('Y-m-d H:i:s');

        $checkIn = new \DateTime($visit['check_in']);
        $checkOut = new \DateTime($checkOutTime);

        $duration = (int) floor(
            ($checkOut->getTimestamp() - $checkIn->getTimestamp()) / 60
        );

        $duration = max(0, $duration);

        $visitModel->update($id, [
            'status'    => 'Selesai',
            'check_out' => $checkOutTime,
            'duration'  => $duration,
        ]);

        return redirect()
            ->to(site_url('petugas/bukutamu-kunjungan/detail/' . $id))
            ->with('success', 'Kunjungan berhasil di-check-out secara manual.');
    }
}
