<?php

namespace App\Validation;

class AuthValidation
{
    public static function loginRules(): array
    {
        return [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[100]|regex_match[/^[a-zA-Z0-9._-]+$/]',
                'errors' => [
                    'required'    => '{field} wajib diisi.',
                    'min_length'  => '{field} minimal 3 karakter.',
                    'max_length'  => '{field} maksimal 100 karakter.',
                    'regex_match' => '{field} hanya boleh berisi huruf, angka, titik, garis bawah, dan tanda hubung.',
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
