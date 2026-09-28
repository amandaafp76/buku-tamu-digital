<?php

namespace App\Validation;

class UserValidation
{
    public static function rules(bool $requirePassword = false): array
    {
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[100]|regex_match[/^[a-zA-Z0-9._-]+$/]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 100 karakter.',
                    'regex_match' => '{field} hanya boleh berisi huruf, angka, titik, garis bawah, dan tanda hubung.',
                ],
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required|in_list[administrator,petugas]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list' => '{field} tidak valid.',
                ],
            ],
            'active' => [
                'label' => 'Status',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list' => '{field} tidak valid.',
                ],
            ],
        ];

        if ($requirePassword) {
            $rules = array_merge(
                $rules,
                self::passwordRules()
            );
        }

        return $rules;
    }

    public static function passwordRules(): array
    {
        return [
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[72]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 8 karakter.',
                    'max_length' => '{field} maksimal 72 karakter.',
                ],
            ],
            'password_confirm' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'matches' => '{field} tidak sama dengan Password.',
                ],
            ],
        ];
    }
}
