<?php

namespace App\Controllers;

use App\Models\InstitutionModel;
use App\Validation\InstitutionValidation;

class InstitutionController extends BaseController
{
    protected InstitutionModel $institutionModel;

    public function __construct()
    {
        $this->institutionModel = new InstitutionModel();
    }

    public function index()
    {
        $institution = $this->institutionModel
            ->where('active', true)
            ->first();

        return view('admin/institution/index', [
            'institution' => $institution,
        ]);
    }

    public function edit()
    {
        $institution = $this->institutionModel
            ->where('active', true)
            ->first();

        if (!$institution) {
            return view('admin/institution/edit', [
                'institution' => null,
            ]);
        }

        return view('admin/institution/edit', [
            'institution' => $institution,
        ]);
    }

    public function update()
    {
        $institution = $this->institutionModel
            ->where('active', true)
            ->first();

        if (!$institution) {
            return redirect()
                ->to('/admin/bukutamu-identitas-institusi')
                ->with('error', 'Data identitas institusi tidak ditemukan.');
        }

        $logoFile = $this->request->getFile('logo');

        $hasLogo = $logoFile
            && $logoFile->getError() !== UPLOAD_ERR_NO_FILE;

        $rules = InstitutionValidation::rules($hasLogo);

        if (!$this->validate($rules)) {
            return view('admin/institution/edit', [
                'institution' => $institution,
                'validation' => $this->validator,
            ]);
        }

        $data = [
            'name' => trim((string) $this->request->getPost('name')),
            'address' => trim((string) $this->request->getPost('address')),
            'phone' => trim((string) $this->request->getPost('phone')),
            'email' => trim((string) $this->request->getPost('email')),
        ];

        if (
            $logoFile &&
            $logoFile->isValid() &&
            !$logoFile->hasMoved()
        ) {
            $uploadPath = FCPATH . 'uploads/institutions/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newLogoName = $logoFile->getRandomName();

            $logoFile->move(
                $uploadPath,
                $newLogoName
            );

            if (!empty($institution['logo'])) {
                $oldLogoPath = FCPATH . $institution['logo'];

                if (
                    is_file($oldLogoPath) &&
                    str_starts_with(
                        realpath($oldLogoPath) ?: '',
                        realpath($uploadPath) ?: ''
                    )
                ) {
                    unlink($oldLogoPath);
                }
            }

            $data['logo'] =
                'uploads/institutions/' . $newLogoName;
        }

        $this->institutionModel->update(
            $institution['id'],
            $data
        );

        $this->logActivity(
            'update',
            'institution',
            (int) $institution['id'],
            'Memperbarui identitas institusi "' .
                $data['name'] .
                '".'
        );

        return redirect()
            ->to('/admin/bukutamu-identitas-institusi')
            ->with(
                'success',
                'Data identitas institusi berhasil diperbarui.'
            );
    }
}
