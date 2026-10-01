<?php

namespace App\Controllers;

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\VisitPurposeModel;
use App\Validation\GuestValidation;

class GuestController extends BaseController
{
    public function index(): string
    {
        return view('guest/kiosk');
    }

    public function register(): string
    {
        $sessionData = session()->get('bukutamu_kiosk') ?? [];

        return view('guest/register', [
            'guest' => $sessionData,
        ]);
    }

    public function storeIdentity()
    {
        if (! $this->validate(GuestValidation::identityRules())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_lengkap'    => trim((string) $this->request->getPost('nama_lengkap')),
            'nomor_hp'        => trim((string) $this->request->getPost('nomor_hp')),
            'alamat'          => trim((string) $this->request->getPost('alamat')),
            'asal_instansi'   => trim((string) $this->request->getPost('asal_instansi')),
            'jenis_identitas' => trim((string) $this->request->getPost('jenis_identitas')),
            'nomor_identitas' => trim((string) $this->request->getPost('nomor_identitas')),
            'group_size'      => (int) $this->request->getPost('group_size'),
        ];

        session()->set('bukutamu_kiosk', $data);

        return redirect()->to(
            site_url('bukutamu-kiosk/tujuan')
        );
    }

    public function purpose()
    {
        $guest = session()->get('bukutamu_kiosk');

        if (empty($guest)) {
            return redirect()->to(
                site_url('bukutamu-kiosk/registrasi')
            );
        }

        $departmentModel = new DepartmentModel();
        $purposeModel    = new VisitPurposeModel();

        return view('guest/purpose', [
            'guest' => $guest,

            'departments' => $departmentModel
                ->where('active', 1)
                ->orderBy('name', 'ASC')
                ->findAll(),

            'purposes' => $purposeModel
                ->where('active', 1)
                ->orderBy('purpose_name', 'ASC')
                ->findAll(),
        ]);
    }

    public function employeesByDepartment(int $departmentId)
    {
        $departmentModel = new DepartmentModel();
        $employeeModel   = new EmployeeModel();

        $department = $departmentModel
            ->select('id')
            ->where('id', $departmentId)
            ->where('active', 1)
            ->first();

        if (! $department) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'message' => 'Departemen tidak ditemukan.'
                ]);
        }

        $employees = $employeeModel
            ->select('id, employee_name')
            ->where('department_id', $departmentId)
            ->where('active', 1)
            ->orderBy('employee_name', 'ASC')
            ->findAll();

        return $this->response
            ->setStatusCode(200)
            ->setJSON($employees);
    }

    public function storePurpose()
    {
        $guest = session()->get('bukutamu_kiosk');

        if (empty($guest)) {
            return redirect()->to(
                site_url('bukutamu-kiosk/registrasi')
            );
        }

        if (! $this->validate(GuestValidation::purposeRules())) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $departmentId = (int) $this->request->getPost('department_id');
        $employeeId   = (int) $this->request->getPost('employee_id');
        $purposeId    = (int) $this->request->getPost('purpose_id');

        $departmentModel = new DepartmentModel();
        $employeeModel   = new EmployeeModel();
        $purposeModel    = new VisitPurposeModel();

        $department = $departmentModel
            ->where('id', $departmentId)
            ->where('active', 1)
            ->first();

        if (! $department) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'department_id' => 'Bagian / Departemen yang dipilih tidak valid.'
                ]);
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
                ->with('errors', [
                    'employee_id' => 'Pegawai yang dipilih tidak sesuai dengan departemen.'
                ]);
        }

        $purpose = $purposeModel
            ->where('id', $purposeId)
            ->where('active', 1)
            ->first();

        if (! $purpose) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', [
                    'purpose_id' => 'Tujuan kunjungan yang dipilih tidak valid.'
                ]);
        }

        $purposeData = [
            'department_id' => $departmentId,
            'employee_id'   => $employeeId,
            'purpose_id'    => $purposeId,
            'keperluan'     => trim((string) $this->request->getPost('keperluan')),
        ];

        session()->set(
            'bukutamu_kiosk',
            array_merge($guest, $purposeData)
        );

        return redirect()->to(
            site_url('bukutamu-kiosk/foto')
        );
    }
}
