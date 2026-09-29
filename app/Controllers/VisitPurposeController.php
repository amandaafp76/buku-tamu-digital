<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VisitPurposeModel;
use App\Validation\VisitPurposeValidation;

class VisitPurposeController extends BaseController
{
    protected VisitPurposeModel $visitPurposeModel;

    public function __construct()
    {
        $this->visitPurposeModel = new VisitPurposeModel();
    }

    public function index(): string
    {
        $search = trim((string) $this->request->getGet('search'));
        $status = $this->request->getGet('status');

        $query = $this->visitPurposeModel
            ->select('visit_purposes.*')
            ->select('COUNT(visits.id) AS visit_count')
            ->join(
                'visits',
                'visits.purpose_id = visit_purposes.id',
                'left'
            )
            ->groupBy('visit_purposes.id');

        if ($search !== '') {
            $query->like(
                'visit_purposes.purpose_name',
                $search
            );
        }

        if ($status !== null && $status !== '') {
            $query->where(
                'visit_purposes.active',
                $status === 'aktif' ? 1 : 0
            );
        }

        $visitPurposes = $query
            ->orderBy('visit_purposes.purpose_name', 'ASC')
            ->findAll();

        return view('admin/visit_purposes/index', [
            'title'         => 'Tujuan Kunjungan',
            'pageTitle'     => 'Tujuan Kunjungan',
            'visitPurposes' => $visitPurposes,
            'search'        => $search,
            'status'        => $status,
        ]);
    }

    public function create(): string
    {
        return view('admin/visit_purposes/tambah', [
            'title'     => 'Tambah Tujuan Kunjungan',
            'pageTitle' => 'Tambah Tujuan Kunjungan',
        ]);
    }

    public function store()
    {
        $rules = VisitPurposeValidation::rules();

        if (! $this->validate($rules)) {

            if ($this->request->isAJAX()) {

                return view('admin/visit_purposes/tambah', [
                    'title'     => 'Tambah Tujuan Kunjungan',
                    'pageTitle' => 'Tambah Tujuan Kunjungan',
                    'errors'    => $this->validator->getErrors(),
                    'formData'  => $this->request->getPost(),
                ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }


        $purposeName = ucwords(
            strtolower(
                trim((string) $this->request->getPost('purpose_name'))
            )
        );


        $existingPurpose = $this->visitPurposeModel
            ->where('purpose_name', $purposeName)
            ->first();

        if ($existingPurpose !== null) {

            $message = 'Nama Tujuan Kunjungan sudah digunakan.';

            if ($this->request->isAJAX()) {

                return view('admin/visit_purposes/tambah', [
                    'title'     => 'Tambah Tujuan Kunjungan',
                    'pageTitle' => 'Tambah Tujuan Kunjungan',
                    'errors'    => [
                        'purpose_name' => $message,
                    ],
                    'formData' => $this->request->getPost(),
                ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $message);
        }


        $this->visitPurposeModel->insert([
            'purpose_name' => $purposeName,
            'active'       => (int) $this->request->getPost('active'),
        ]);

        $purposeId = $this->visitPurposeModel->getInsertID();

        $this->logActivity(
            'create',
            'visit_purpose',
            (int) $purposeId,
            'Menambahkan Tujuan Kunjungan "' . $purposeName . '".'
        );

        return redirect()
            ->to(base_url('admin/bukutamu-tujuan'))
            ->with(
                'success',
                'Tujuan Kunjungan "' . $purposeName .
                    '" berhasil ditambahkan.'
            );
    }

    public function edit(int $id): string
    {
        $visitPurpose = $this->visitPurposeModel->find($id);

        if ($visitPurpose === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data Tujuan Kunjungan tidak ditemukan.'
            );
        }

        return view('admin/visit_purposes/edit', [
            'title'       => 'Edit Tujuan Kunjungan',
            'pageTitle'   => 'Edit Tujuan Kunjungan',
            'visitPurpose' => $visitPurpose,
        ]);
    }

    public function update(int $id)
    {
        $visitPurpose = $this->visitPurposeModel->find($id);

        if ($visitPurpose === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data Tujuan Kunjungan tidak ditemukan.'
            );
        }

        $rules = VisitPurposeValidation::rules();

        if (! $this->validate($rules)) {

            if ($this->request->isAJAX()) {
                return view('admin/visit_purposes/edit', [
                    'title'       => 'Edit Tujuan Kunjungan',
                    'pageTitle'   => 'Edit Tujuan Kunjungan',
                    'visitPurpose' => $visitPurpose,
                    'errors'      => $this->validator->getErrors(),
                    'formData'    => $this->request->getPost(),
                ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $purposeName = ucwords(
            strtolower(
                trim((string) $this->request->getPost('purpose_name'))
            )
        );

        $existingPurpose = $this->visitPurposeModel
            ->where('purpose_name', $purposeName)
            ->where('id !=', $id)
            ->first();

        if ($existingPurpose !== null) {

            $message = 'Nama Tujuan Kunjungan sudah digunakan.';

            if ($this->request->isAJAX()) {
                return view('admin/visit_purposes/edit', [
                    'title'        => 'Edit Tujuan Kunjungan',
                    'pageTitle'    => 'Edit Tujuan Kunjungan',
                    'visitPurpose' => $visitPurpose,
                    'errors'       => [
                        'purpose_name' => $message,
                    ],
                    'formData' => $this->request->getPost(),
                ]);
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $message);
        }

        $this->visitPurposeModel->update($id, [
            'purpose_name' => $purposeName,
            'active'       => (int) $this->request->getPost('active'),
        ]);

        $this->logActivity(
            'update',
            'visit_purpose',
            $id,
            'Memperbarui Tujuan Kunjungan "' . $purposeName . '".'
        );

        return redirect()
            ->to(base_url('admin/bukutamu-tujuan'))
            ->with(
                'success',
                'Tujuan Kunjungan "' . $purposeName . '" berhasil diperbarui.'
            );
    }

    public function confirmDelete(int $id): string
    {
        $visitPurpose = $this->visitPurposeModel
            ->select('visit_purposes.*')
            ->select('COUNT(visits.id) AS visit_count')
            ->join(
                'visits',
                'visits.purpose_id = visit_purposes.id',
                'left'
            )
            ->where('visit_purposes.id', $id)
            ->groupBy('visit_purposes.id')
            ->first();

        if ($visitPurpose === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data Tujuan Kunjungan tidak ditemukan.'
            );
        }

        return view('admin/visit_purposes/hapus', [
            'visitPurpose' => $visitPurpose,
            'visitCount'   => (int) $visitPurpose['visit_count'],
        ]);
    }

    public function delete(int $id)
    {
        $visitPurpose = $this->visitPurposeModel->find($id);

        if ($visitPurpose === null) {
            return redirect()
                ->to(base_url('admin/bukutamu-tujuan'))
                ->with(
                    'error',
                    'Data Tujuan Kunjungan tidak ditemukan.'
                );
        }

        $visitCount = $this->visitPurposeModel
            ->join(
                'visits',
                'visits.purpose_id = visit_purposes.id',
                'inner'
            )
            ->where('visit_purposes.id', $id)
            ->countAllResults();

        if ($visitCount > 0) {
            return redirect()
                ->to(base_url('admin/bukutamu-tujuan'))
                ->with(
                    'error',
                    'Tujuan Kunjungan "' . $visitPurpose['purpose_name'] .
                        '" tidak dapat dihapus karena sudah digunakan pada ' .
                        $visitCount . ' kunjungan.'
                );
        }

        $this->visitPurposeModel->delete($id);

        $this->logActivity(
            'delete',
            'visit_purpose',
            $id,
            'Menghapus Tujuan Kunjungan "' .
                $visitPurpose['purpose_name'] .
                '".'
        );

        return redirect()
            ->to(base_url('admin/bukutamu-tujuan'))
            ->with(
                'success',
                'Tujuan Kunjungan "' . $visitPurpose['purpose_name'] .
                    '" berhasil dihapus.'
            );
    }
}
