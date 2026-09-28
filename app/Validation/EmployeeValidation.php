<?php

namespace App\Validation;

class EmployeeValidation
{
    public static function rules(): array
    {
        return [
            'employee_name' => [
                'label' => 'Nama Pegawai',
                'rules' => 'required|max_length[50]|regex_match[/^[a-zA-ZÀ-ÿ\s]+$/]',
                'errors' => [
                    'required'    => '{field} wajib diisi.',
                    'max_length'  => '{field} maksimal 50 karakter.',
                    'regex_match' => '{field} hanya boleh berisi huruf dan spasi.',
                ],
            ],

            'phone' => [
                'label' => 'Nomor HP',
                'rules' => 'required|min_length[10]|max_length[15]|regex_match[/^[0-9+]+$/]',
                'errors' => [
                    'required'    => '{field} wajib diisi.',
                    'min_length'  => '{field} terlalu pendek. Masukkan minimal 10 digit.',
                    'max_length'  => '{field} maksimal 15 karakter.',
                    'regex_match' => '{field} hanya boleh berisi angka dan tanda +.',
                ],
            ],

            'department_id' => [
                'label' => 'Bagian/Departemen',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required'           => '{field} wajib dipilih.',
                    'is_natural_no_zero' => '{field} tidak valid.',
                ],
            ],

            'active' => [
                'label' => 'Status',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid.',
                ],
            ],
        ];
    }
}
