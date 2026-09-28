<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\DepartmentModel;
use App\Validation\EmployeeValidation;

class EmployeeController extends BaseController
{
    protected EmployeeModel $employeeModel;
    protected DepartmentModel $departmentModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
        $this->departmentModel = new DepartmentModel();
    }

    public function index(): string
    {
        $search     = trim((string) $this->request->getGet('search'));
        $department = $this->request->getGet('department');
        $status     = $this->request->getGet('status');

        $query = $this->employeeModel
            ->select('employees.*, departments.name AS department_name')
            ->join(
                'departments',
                'departments.id = employees.department_id',
                'left'
            );

        if ($search !== '') {
            $query->groupStart()
                ->like('employees.employee_name', $search)
                ->orLike('employees.phone', $search)
                ->groupEnd();
        }

        if ($department !== null && $department !== '') {
            $query->where('employees.department_id', $department);
        }

        if ($status !== null && $status !== '') {
            $query->where(
                'employees.active',
                $status === 'aktif' ? 1 : 0
            );
        }

        $employees = $query
            ->orderBy('employees.employee_name', 'ASC')
            ->findAll();

        $departments = $this->departmentModel
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('admin/employees/index', [
            'title'       => 'Pegawai',
            'pageTitle'   => 'Pegawai',
            'employees'   => $employees,
            'departments' => $departments,
            'search'      => $search,
            'department'  => $department,
            'status'      => $status,
        ]);
    }

    public function create(): string
    {
        $departments = $this->departmentModel
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('admin/employees/tambah', [
            'title'       => 'Tambah Pegawai',
            'pageTitle'   => 'Tambah Pegawai',
            'departments' => $departments,
        ]);
    }

    public function store()
    {
        $rules = EmployeeValidation::rules();

        if (! $this->validate($rules)) {

            if ($this->request->isAJAX()) {

                $departments = $this->departmentModel
                    ->orderBy('name', 'ASC')
                    ->findAll();

                return view('admin/employees/tambah', [
                    'title'       => 'Tambah Pegawai',
                    'pageTitle'   => 'Tambah Pegawai',
                    'departments' => $departments,
                    'errors'      => $this->validator->getErrors(),
                    'formData'    => $this->request->getPost(),
                ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $departmentId = (int) $this->request->getPost('department_id');

        $department = $this->departmentModel->find($departmentId);

        if ($department === null) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Bagian/Departemen yang dipilih tidak ditemukan.');
        }

        $this->employeeModel->insert([
            'department_id' => $departmentId,
            'employee_name' => trim($this->request->getPost('employee_name')),
            'phone'         => trim($this->request->getPost('phone')),
            'active'        => (int) $this->request->getPost('active'),
        ]);

        return redirect()
            ->to(base_url('admin/bukutamu-pegawai'))
            ->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function edit(int $id): string
    {
        $employee = $this->employeeModel->find($id);

        if ($employee === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data pegawai tidak ditemukan.'
            );
        }

        $departments = $this->departmentModel
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('admin/employees/edit', [
            'title'       => 'Edit Pegawai',
            'pageTitle'   => 'Edit Pegawai',
            'employee'    => $employee,
            'departments' => $departments,
        ]);
    }

    public function update(int $id)
    {
        $employee = $this->employeeModel->find($id);

        if ($employee === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data pegawai tidak ditemukan.'
            );
        }

        $rules = EmployeeValidation::rules();

        if (! $this->validate($rules)) {

            $departments = $this->departmentModel
                ->orderBy('name', 'ASC')
                ->findAll();

            if ($this->request->isAJAX()) {
                return view('admin/employees/edit', [
                    'title'       => 'Edit Pegawai',
                    'pageTitle'   => 'Edit Pegawai',
                    'employee'    => $employee,
                    'departments' => $departments,
                    'errors'      => $this->validator->getErrors(),
                    'formData'    => $this->request->getPost(),
                ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $departmentId = (int) $this->request->getPost('department_id');

        $department = $this->departmentModel->find($departmentId);

        if ($department === null) {
            if ($this->request->isAJAX()) {
                return view('admin/employees/edit', [
                    'title'       => 'Edit Pegawai',
                    'pageTitle'   => 'Edit Pegawai',
                    'employee'    => $employee,
                    'departments' => $this->departmentModel
                        ->orderBy('name', 'ASC')
                        ->findAll(),
                    'errors'      => [
                        'department_id' =>
                        'Bagian/Departemen yang dipilih tidak ditemukan.',
                    ],
                    'formData' => $this->request->getPost(),
                ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Bagian/Departemen yang dipilih tidak ditemukan.');
        }

        $this->employeeModel->update($id, [
            'department_id' => $departmentId,
            'employee_name' => trim(
                $this->request->getPost('employee_name')
            ),
            'phone'         => trim(
                $this->request->getPost('phone')
            ),
            'active'        => (int) $this->request->getPost('active'),
        ]);

        return redirect()
            ->to(base_url('admin/bukutamu-pegawai'))
            ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function confirmDelete(int $id): string
    {
        $employee = $this->employeeModel
            ->select('employees.*, departments.name AS department_name')
            ->join(
                'departments',
                'departments.id = employees.department_id',
                'left'
            )
            ->find($id);

        if ($employee === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data pegawai tidak ditemukan.'
            );
        }

        return view('admin/employees/hapus', [
            'employee' => $employee,
        ]);
    }

    public function delete(int $id)
    {
        $employee = $this->employeeModel->find($id);

        if ($employee === null) {
            return redirect()
                ->to(base_url('admin/bukutamu-pegawai'))
                ->with('error', 'Data pegawai tidak ditemukan.');
        }

        $this->employeeModel->delete($id);

        return redirect()
            ->to(base_url('admin/bukutamu-pegawai'))
            ->with(
                'success',
                'Data pegawai "' . $employee['employee_name'] . '" berhasil dihapus.'
            );
    }
}
