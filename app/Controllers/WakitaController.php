<?php

namespace App\Controllers;

use App\Models\SettingModel;
use App\Models\InstitutionModel;
use App\Validation\WakitaValidation;

class WakitaController extends BaseController
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
            return view('admin/wakita/index', [
                'institution' => null,
                'setting' => null,
            ]);
        }

        $setting = $this->settingModel
            ->where('institution_id', $institution['id'])
            ->first();

        return view('admin/wakita/index', [
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
            return view('admin/wakita/edit', [
                'institution' => null,
                'setting' => null,
            ]);
        }

        $setting = $this->settingModel
            ->where('institution_id', $institution['id'])
            ->first();

        return view('admin/wakita/edit', [
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
                ->to('/admin/bukutamu-wakita')
                ->with(
                    'error',
                    'Data institusi aktif tidak ditemukan.'
                );
        }


        $rules = WakitaValidation::rules();

        if (! $this->validate($rules)) {

            $setting = $this->settingModel
                ->where(
                    'institution_id',
                    $institution['id']
                )
                ->first();

            return view('admin/wakita/edit', [
                'institution' => $institution,
                'setting' => $setting,
                'validation' => $this->validator,
            ]);
        }


        $data = [
            'institution_id' => $institution['id'],

            'wakita_enabled' =>
            (int) $this->request
                ->getPost('wakita_enabled'),

            'wakita_api_url' =>
            trim(
                (string) $this->request
                    ->getPost('wakita_api_url')
            ),

            'wakita_api_key' =>
            trim(
                (string) $this->request
                    ->getPost('wakita_api_key')
            ),

            'wakita_sender' =>
            trim(
                (string) $this->request
                    ->getPost('wakita_sender')
            ),
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
                'wakita',
                (int) $existingSetting['id'],
                'Memperbarui konfigurasi WAKITA untuk institusi "' .
                    $institution['name'] .
                    '".'
            );
        } else {

            $this->settingModel->insert($data);

            $settingId = $this->settingModel->getInsertID();

            $this->logActivity(
                'create',
                'wakita',
                (int) $settingId,
                'Menambahkan konfigurasi WAKITA untuk institusi "' .
                    $institution['name'] .
                    '".'
            );
        }


        return redirect()
            ->to('/admin/bukutamu-wakita')
            ->with(
                'success',
                'Konfigurasi WAKITA berhasil diperbarui.'
            );
    }
}
