<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Validation\DepartmentValidation;

class DepartmentController extends BaseController
{
    protected DepartmentModel $departmentModel;
    protected EmployeeModel $employeeModel;

    public function __construct()
    {
        $this->departmentModel = new DepartmentModel();
        $this->employeeModel = new EmployeeModel();
    }

    public function index(): string
    {
        $search = trim((string) $this->request->getGet('search'));
        $status = $this->request->getGet('status');

        $query = $this->departmentModel
            ->select('departments.*')
            ->select(
                'COUNT(employees.id) AS employee_count'
            )
            ->join(
                'employees',
                'employees.department_id = departments.id
                AND employees.deleted_at IS NULL',
                'left'
            )
            ->groupBy('departments.id');

        if ($search !== '') {
            $query->like('departments.name', $search);
        }

        if ($status !== null && $status !== '') {
            $query->where(
                'departments.active',
                $status === 'aktif' ? 1 : 0
            );
        }

        $departments = $query
            ->orderBy('departments.name', 'ASC')
            ->findAll();

        return view('admin/departments/index', [
            'title'       => 'Bagian/Departemen',
            'pageTitle'   => 'Bagian/Departemen',
            'departments' => $departments,
            'search'      => $search,
            'status'      => $status,
        ]);
    }

    public function create(): string
    {
        return view('admin/departments/tambah', [
            'title'     => 'Tambah Bagian/Departemen',
            'pageTitle' => 'Tambah Bagian/Departemen',
        ]);
    }

    public function store()
    {
        $rules = DepartmentValidation::rules();

        if (! $this->validate($rules)) {

            if ($this->request->isAJAX()) {
                return view('admin/departments/tambah', [
                    'title'     => 'Tambah Bagian/Departemen',
                    'pageTitle' => 'Tambah Bagian/Departemen',
                    'errors'    => $this->validator->getErrors(),
                    'formData'  => $this->request->getPost(),
                ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $name = ucwords(
            strtolower(
                trim((string) $this->request->getPost('name'))
            )
        );

        $existingDepartment = $this->departmentModel
            ->where('name', $name)
            ->first();

        if ($existingDepartment !== null) {

            $message = 'Nama Bagian/Departemen sudah digunakan.';

            if ($this->request->isAJAX()) {
                return view('admin/departments/tambah', [
                    'title'     => 'Tambah Bagian/Departemen',
                    'pageTitle' => 'Tambah Bagian/Departemen',
                    'errors'    => [
                        'name' => $message,
                    ],
                    'formData'  => $this->request->getPost(),
                ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $message);
        }

        $this->departmentModel->insert([
            'name'   => $name,
            'active' => (int) $this->request->getPost('active'),
        ]);

        return redirect()
            ->to(base_url('admin/bukutamu-departemen'))
            ->with(
                'success',
                'Bagian/Departemen "' . $name . '" berhasil ditambahkan.'
            );
    }

    public function edit(int $id): string
    {
        $department = $this->departmentModel->find($id);

        if ($department === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data Bagian/Departemen tidak ditemukan.'
            );
        }

        return view('admin/departments/edit', [
            'title'      => 'Edit Bagian/Departemen',
            'pageTitle'  => 'Edit Bagian/Departemen',
            'department' => $department,
        ]);
    }

    public function update(int $id)
    {
        $department = $this->departmentModel->find($id);

        if ($department === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data Bagian/Departemen tidak ditemukan.'
            );
        }

        $rules = DepartmentValidation::rules();

        if (! $this->validate($rules)) {

            if ($this->request->isAJAX()) {
                return view('admin/departments/edit', [
                    'title'      => 'Edit Bagian/Departemen',
                    'pageTitle'  => 'Edit Bagian/Departemen',
                    'department' => $department,
                    'errors'     => $this->validator->getErrors(),
                    'formData'   => $this->request->getPost(),
                ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $name = ucwords(
            strtolower(
                trim((string) $this->request->getPost('name'))
            )
        );

        $existingDepartment = $this->departmentModel
            ->where('name', $name)
            ->where('id !=', $id)
            ->first();

        if ($existingDepartment !== null) {

            $message = 'Nama Bagian/Departemen sudah digunakan.';

            if ($this->request->isAJAX()) {
                return view('admin/departments/edit', [
                    'title'      => 'Edit Bagian/Departemen',
                    'pageTitle'  => 'Edit Bagian/Departemen',
                    'department' => $department,
                    'errors'     => [
                        'name' => $message,
                    ],
                    'formData'   => $this->request->getPost(),
                ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $message);
        }

        $this->departmentModel->update($id, [
            'name'   => $name,
            'active' => (int) $this->request->getPost('active'),
        ]);

        return redirect()
            ->to(base_url('admin/bukutamu-departemen'))
            ->with(
                'success',
                'Bagian/Departemen "' . $name . '" berhasil diperbarui.'
            );
    }

    public function confirmDelete(int $id): string
    {
        $department = $this->departmentModel->find($id);

        if ($department === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data Bagian/Departemen tidak ditemukan.'
            );
        }

        $employeeCount = $this->employeeModel
            ->where('department_id', $id)
            ->countAllResults();

        return view('admin/departments/hapus', [
            'department'    => $department,
            'employeeCount' => $employeeCount,
        ]);
    }
    public function delete(int $id)
    {
        $department = $this->departmentModel->find($id);

        if ($department === null) {
            return redirect()
                ->to(base_url('admin/bukutamu-departemen'))
                ->with(
                    'error',
                    'Data Bagian/Departemen tidak ditemukan.'
                );
        }

        $employeeCount = $this->employeeModel
            ->where('department_id', $id)
            ->countAllResults();

        if ($employeeCount > 0) {
            return redirect()
                ->to(base_url('admin/bukutamu-departemen'))
                ->with(
                    'error',
                    'Bagian/Departemen "' . $department['name'] .
                        '" tidak dapat dihapus karena masih memiliki ' .
                        $employeeCount . ' pegawai.'
                );
        }

        $this->departmentModel->delete($id);

        return redirect()
            ->to(base_url('admin/bukutamu-departemen'))
            ->with(
                'success',
                'Bagian/Departemen "' . $department['name'] .
                    '" berhasil dihapus.'
            );
    }
}
