<?php

namespace App\Validation;

class WakitaValidation
{
    public static function rules(): array
    {
        return [
            'wakita_enabled' => [
                'label' => 'Status WAKITA',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid.',
                ],
            ],

            'wakita_api_url' => [
                'label' => 'API URL',
                'rules' => 'permit_empty|valid_url|max_length[255]',
                'errors' => [
                    'valid_url'  => '{field} harus berupa URL yang valid.',
                    'max_length' => '{field} maksimal 255 karakter.',
                ],
            ],

            'wakita_api_key' => [
                'label' => 'API Key',
                'rules' => 'permit_empty|max_length[100]',
                'errors' => [
                    'max_length' => '{field} maksimal 100 karakter.',
                ],
            ],

            'wakita_sender' => [
                'label' => 'Sender',
                'rules' => 'permit_empty|max_length[20]',
                'errors' => [
                    'max_length' => '{field} maksimal 20 karakter.',
                ],
            ],
        ];
    }
}
