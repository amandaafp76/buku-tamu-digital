<?php

namespace App\Validation;

class DepartmentValidation
{
    public static function rules(): array
    {
        return [
            'name' => [
                'label' => 'Nama Bagian/Departemen',
                'rules' => 'required|min_length[3]|max_length[50]|regex_match[/^[a-zA-ZÀ-ÿ0-9\s&.,()\/-]+$/]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 50 karakter.',
                    'regex_match' => '{field} mengandung karakter yang tidak valid.',
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
    }
}
