<?php

namespace App\Controllers;

use App\Models\SettingModel;
use App\Models\InstitutionModel;
use App\Validation\SettingValidation;

class SettingController extends BaseController
{
    protected SettingModel $settingModel;
    protected InstitutionModel $institutionModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
        $this->institutionModel = new InstitutionModel();
    }

    public function index()
    {
        $institution = $this->institutionModel
            ->where('active', true)
            ->first();

        if (!$institution) {
            return view('admin/setting/index', [
                'institution' => null,
                'setting' => null,
            ]);
        }

        $setting = $this->settingModel
            ->where('institution_id', $institution['id'])
            ->first();

        return view('admin/setting/index', [
            'institution' => $institution,
            'setting' => $setting,
        ]);
    }

    public function edit()
    {
        $institution = $this->institutionModel
            ->where('active', true)
            ->first();

        if (!$institution) {
            return view('admin/setting/edit', [
                'institution' => null,
                'setting' => null,
            ]);
        }

        $setting = $this->settingModel
            ->where('institution_id', $institution['id'])
            ->first();

        return view('admin/setting/edit', [
            'institution' => $institution,
            'setting' => $setting,
        ]);
    }

    public function update()
    {
        $institution = $this->institutionModel
            ->where('active', true)
            ->first();

        if (!$institution) {
            return redirect()
                ->to('/admin/bukutamu-konfigurasi')
                ->with(
                    'error',
                    'Data institusi aktif tidak ditemukan.'
                );
        }

        $rules = SettingValidation::rules();

        if (!$this->validate($rules)) {
            $setting = $this->settingModel
                ->where(
                    'institution_id',
                    $institution['id']
                )
                ->first();

            return view('admin/setting/edit', [
                'institution' => $institution,
                'setting' => $setting,
                'validation' => $this->validator,
            ]);
        }

        $data = [
            'institution_id' => $institution['id'],
            'primary_color' => strtoupper(
                trim(
                    (string) $this->request
                        ->getPost('primary_color')
                )
            ),
            'require_photo' =>
            (int) $this->request
                ->getPost('require_photo'),
            'require_signature' =>
            (int) $this->request
                ->getPost('require_signature'),
            'photo_size' =>
            (int) $this->request
                ->getPost('photo_size'),
            'warning_limit' =>
            (int) $this->request
                ->getPost('warning_limit'),
        ];

        $existingSetting = $this->settingModel
            ->where(
                'institution_id',
                $institution['id']
            )
            ->first();

        if ($existingSetting) {
            $this->settingModel->update(
                $existingSetting['id'],
                $data
            );
            $this->logActivity(
                'update',
                'setting',
                (int) $existingSetting['id'],
                'Memperbarui konfigurasi sistem untuk institusi "' .
                    $institution['name'] .
                    '".'
            );
        } else {
            $this->settingModel->insert($data);

            $settingId = $this->settingModel->getInsertID();

            $this->logActivity(
                'create',
                'setting',
                (int) $settingId,
                'Menambahkan konfigurasi sistem untuk institusi "' .
                    $institution['name'] .
                    '".'
            );
        }

        return redirect()
            ->to('/admin/bukutamu-konfigurasi')
            ->with(
                'success',
                'Konfigurasi sistem berhasil diperbarui.'
            );
    }
}
