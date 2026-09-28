<?php

namespace App\Validation;

class SettingValidation
{
    public static function rules(): array
    {
        return [
            'primary_color' => [
                'label' => 'Warna utama',
                'rules' => [
                    'required',
                    'regex_match[/^#[0-9A-Fa-f]{6}$/]',
                ],
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'regex_match' => '{field} harus menggunakan format warna HEX.',
                ],
            ],

            'require_photo' => [
                'label' => 'Wajib foto',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid.',
                ],
            ],

            'require_signature' => [
                'label' => 'Wajib tanda tangan',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid.',
                ],
            ],

            'photo_size' => [
                'label' => 'Ukuran foto',
                'rules' => 'required|is_natural',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'is_natural' => '{field} harus berupa angka yang valid.',
                ],
            ],

            'warning_limit' => [
                'label' => 'Batas peringatan',
                'rules' => 'required|is_natural',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'is_natural' => '{field} harus berupa angka yang valid.',
                ],
            ],
        ];
    }
}
