<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VisitModel;
use App\Models\GuestModel;
use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\VisitPurposeModel;
use App\Services\VisitService;

class AdminVisitController extends BaseController
{
    protected VisitService $visitService;

    protected VisitModel $visitModel;

    protected GuestModel $guestModel;

    protected DepartmentModel $departmentModel;

    protected EmployeeModel $employeeModel;

    protected VisitPurposeModel $purposeModel;

    public function __construct()
    {
        $this->visitService = new VisitService();
        $this->visitModel   = new VisitModel();
        $this->guestModel     = new GuestModel();
        $this->departmentModel = new DepartmentModel();
        $this->employeeModel  = new EmployeeModel();
        $this->purposeModel   = new VisitPurposeModel();
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

        return view('admin/kunjungan/index', [
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
                        'admin/bukutamu-kunjungan'
                    )
                )
                ->with(
                    'error',
                    'Data kunjungan tidak ditemukan.'
                );
        }

        return view(
            'admin/kunjungan/detail',
            [
                'visit' => $visit,
            ]
        );
    }

    public function edit(int $id): string
    {
        $visit = $this->visitService->getVisitDetail($id);

        if ($visit === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data kunjungan tidak ditemukan.'
            );
        }

        if ($visit['status'] !== 'Menunggu') {
            return redirect()
                ->to(
                    site_url(
                        'admin/bukutamu-kunjungan/detail/' . $id
                    )
                )
                ->with(
                    'error',
                    'Data kunjungan hanya dapat diperbaiki saat status masih Menunggu.'
                );
        }

        $departments = $this->departmentModel
            ->where('active', 1)
            ->orderBy('name', 'ASC')
            ->findAll();

        $employees = $this->employeeModel
            ->where('active', 1)
            ->orderBy('employee_name', 'ASC')
            ->findAll();

        $purposes = $this->purposeModel
            ->where('active', 1)
            ->orderBy('purpose_name', 'ASC')
            ->findAll();

        return view('admin/kunjungan/edit', [
            'visit'       => $visit,
            'departments' => $departments,
            'employees'   => $employees,
            'purposes'    => $purposes,
        ]);
    }

    public function update(int $id)
    {
        $visit = $this->visitService->find($id);

        if ($visit['status'] !== 'Menunggu') {
            return redirect()
                ->to(
                    site_url(
                        'admin/bukutamu-kunjungan/detail/' . $id
                    )
                )
                ->with(
                    'error',
                    'Data kunjungan hanya dapat diperbaiki saat status masih Menunggu.'
                );
        }

        $rules = [
            'guest_name' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 100 karakter.',
                ],
            ],

            'phone' => [
                'label' => 'Nomor HP',
                'rules' => 'required|min_length[10]|max_length[20]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 10 karakter.',
                    'max_length' => '{field} maksimal 20 karakter.',
                ],
            ],

            'address' => [
                'label' => 'Alamat',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal 255 karakter.',
                ],
            ],

            'institution' => [
                'label' => 'Asal Instansi / Perusahaan',
                'rules' => 'required|max_length[255]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal 255 karakter.',
                ],
            ],

            'identity_type' => [
                'label' => 'Jenis Identitas',
                'rules' => 'required|max_length[20]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'max_length' => '{field} maksimal 20 karakter.',
                ],
            ],

            'identity_no' => [
                'label' => 'Nomor Identitas',
                'rules' => 'required|max_length[30]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal 30 karakter.',
                ],
            ],

            'department_id' => [
                'label' => 'Bagian / Departemen',
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

        $departmentId = (int) $this->request->getPost(
            'department_id'
        );

        $employeeId = (int) $this->request->getPost(
            'employee_id'
        );

        $purposeId = (int) $this->request->getPost(
            'purpose_id'
        );

        $department = $this->departmentModel
            ->where('id', $departmentId)
            ->where('active', 1)
            ->first();

        if ($department === null) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Bagian/Departemen yang dipilih tidak valid.'
                );
        }

        $employee = $this->employeeModel
            ->where('id', $employeeId)
            ->where('department_id', $departmentId)
            ->where('active', 1)
            ->first();

        if ($employee === null) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Pegawai tujuan tidak valid atau tidak sesuai dengan Bagian/Departemen.'
                );
        }

        $purpose = $this->purposeModel
            ->where('id', $purposeId)
            ->where('active', 1)
            ->first();

        if ($purpose === null) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Keperluan kunjungan yang dipilih tidak valid.'
                );
        }

        $this->guestModel->update(
            (int) $visit['guest_id'],
            [
                'guest_name'  => trim(
                    (string) $this->request->getPost('guest_name')
                ),
                'phone'       => trim(
                    (string) $this->request->getPost('phone')
                ),
                'address'     => trim(
                    (string) $this->request->getPost('address')
                ),
                'institution' => trim(
                    (string) $this->request->getPost('institution')
                ),
            ]
        );

        $this->visitModel->update(
            $id,
            [
                'department_id' => $departmentId,
                'employee_id'   => $employeeId,
                'purpose_id'    => $purposeId,
                'identity_type' => trim(
                    (string) $this->request->getPost('identity_type')
                ),
                'identity_no'   => trim(
                    (string) $this->request->getPost('identity_no')
                ),
                'group_size'    => (int) $this->request->getPost(
                    'group_size'
                ),
            ]
        );

        $this->logActivity(
            'update',
            'visit',
            $id,
            'Memperbarui data kunjungan "' .
                $visit['visit_code'] .
                '".'
        );

        return redirect()
            ->to(
                site_url(
                    'admin/bukutamu-kunjungan/detail/' . $id
                )
            )
            ->with(
                'success',
                'Data kunjungan berhasil diperbarui.'
            );
    }

    public function confirmDelete(int $id): string
    {
        $visit = $this->visitService->getVisitDetail($id);

        if (! $visit) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data kunjungan tidak ditemukan.'
            );
        }

        return view('admin/kunjungan/hapus', [
            'visit' => $visit,
        ]);
    }

    public function delete(int $id)
    {
        $visit = $this->visitService->find($id);

        if (! $visit) {
            return redirect()
                ->to(
                    site_url(
                        'admin/bukutamu-kunjungan'
                    )
                )
                ->with(
                    'error',
                    'Data kunjungan tidak ditemukan.'
                );
        }

        $this->visitModel->delete($id);

        $this->logActivity(
            'delete',
            'visit',
            $id,
            'Menghapus data kunjungan dengan kode "' .
                $visit['visit_code'] .
                '".'
        );

        return redirect()
            ->to(
                site_url(
                    'admin/bukutamu-kunjungan'
                )
            )
            ->with(
                'success',
                'Data kunjungan "' .
                    $visit['visit_code'] .
                    '" berhasil dihapus.'
            );
    }
}
