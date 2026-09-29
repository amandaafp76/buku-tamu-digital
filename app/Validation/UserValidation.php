<?php

namespace App\Validation;

class UserValidation
{
    public static function rules(bool $requirePassword = false): array
    {
        $rules = [
            'username' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'valid_email' => '{field} harus menggunakan alamat email yang valid.',
                    'max_length' => '{field} maksimal 100 karakter.',
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
                'rules' => [
                    'required',
                    'min_length[8]',
                    'max_length[72]',
                    'regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/]',
                ],
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 8 karakter.',
                    'max_length' => '{field} maksimal 72 karakter.',
                    'regex_match' => '{field} harus mengandung huruf besar, huruf kecil, angka, dan minimal 1 karakter khusus.',
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
