<?php

namespace App\Validation;

class GuestValidation
{
    public static function identityRules(): array
    {
        return [
            'nama_lengkap' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal 100 karakter.',
                ],
            ],

            'nomor_hp' => [
                'label' => 'Nomor HP',
                'rules' => 'required|min_length[10]|max_length[15]|regex_match[/^[0-9+]+$/]',
                'errors' => [
                    'required'    => '{field} wajib diisi.',
                    'min_length'  => '{field} terlalu pendek. Masukkan minimal 10 digit.',
                    'max_length'  => '{field} maksimal 15 karakter.',
                    'regex_match' => '{field} hanya boleh berisi angka dan tanda +.',
                ],
            ],

            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal 150 karakter.',
                ],
            ],

            'asal_instansi' => [
                'label' => 'Asal Instansi / Perusahaan',
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal 100 karakter.',
                ],
            ],

            'jenis_identitas' => [
                'label' => 'Jenis Identitas',
                'rules' => 'required|in_list[KTP,SIM,PASPOR,LAINNYA]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid.',
                ],
            ],

            'nomor_identitas' => [
                'label' => 'Nomor Identitas',
                'rules' => 'required|max_length[30]|regex_match[/^[a-zA-Z0-9]+$/]',
                'errors' => [
                    'required'    => '{field} wajib diisi.',
                    'max_length'  => '{field} maksimal 30 karakter.',
                    'regex_match' => '{field} hanya boleh berisi huruf dan angka.',
                ],
            ],

            'group_size' => [
                'label' => 'Jumlah Rombongan',
                'rules' => 'required|is_natural_no_zero|less_than_equal_to[999]',
                'errors' => [
                    'required'             => '{field} wajib diisi.',
                    'is_natural_no_zero'   => '{field} harus berupa angka lebih dari 0.',
                    'less_than_equal_to'   => '{field} maksimal 999 orang.',
                ],
            ],
        ];
    }

    public static function purposeRules(): array
    {
        return [
            'purpose_id' => [
                'label' => 'Tujuan Kunjungan',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required'           => '{field} wajib dipilih.',
                    'is_natural_no_zero' => '{field} tidak valid.',
                ],
            ],

            'department_id' => [
                'label' => 'Bagian / Departemen',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required'           => '{field} wajib dipilih.',
                    'is_natural_no_zero' => '{field} tidak valid.',
                ],
            ],

            'employee_id' => [
                'label' => 'Pegawai yang Dituju',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required'           => '{field} wajib dipilih.',
                    'is_natural_no_zero' => '{field} tidak valid.',
                ],
            ],

            'keperluan' => [
                'label' => 'Detail Keperluan',
                'rules' => 'required|max_length[500]',
                'errors' => [
                    'required'   => '{field} wajib diisi.',
                    'max_length' => '{field} maksimal 500 karakter.',
                ],
            ],
        ];
    }
}
