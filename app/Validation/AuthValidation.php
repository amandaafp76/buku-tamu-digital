<?php

namespace App\Validation;

class AuthValidation
{
    public static function loginRules(): array
    {
        return [
            'username' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required'    => '{field} wajib diisi.',
                    'valid_email' => '{field} harus menggunakan alamat email yang valid.',
                    'max_length'  => '{field} maksimal 100 karakter.',
                ],
            ],

            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ],
            ],
        ];
    }
}
