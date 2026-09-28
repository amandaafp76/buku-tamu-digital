<?php

namespace App\Validation;

class InstitutionValidation
{
    public static function rules(bool $hasLogo = false): array
    {
        $rules = [
            'name' => [
                'label' => 'Nama instansi',
                'rules' => 'required|max_length[100]',
            ],

            'address' => [
                'label' => 'Alamat',
                'rules' => 'permit_empty|max_length[1000]',
            ],

            'phone' => [
                'label' => 'Nomor telepon',
                'rules' => 'permit_empty|max_length[17]',
            ],

            'email' => [
                'label' => 'Email',
                'rules' => 'permit_empty|valid_email|max_length[60]',
            ],
        ];

        if ($hasLogo) {
            $rules['logo'] = [
                'label' => 'Logo institusi',
                'rules' => [
                    'uploaded[logo]',
                    'is_image[logo]',
                    'mime_in[logo,image/png,image/jpeg,image/webp]',
                    'max_size[logo,2048]',
                ],
            ];
        }

        return $rules;
    }
}
