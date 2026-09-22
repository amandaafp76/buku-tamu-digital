<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GuestsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'guest_name'  => 'Ahmad Fauzi',
                'phone'       => '081234567896',
                'address'     => 'Jl. Merdeka No. 10',
                'institution' => 'PT Maju Jaya',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'guest_name'  => 'Rina Wulandari',
                'phone'       => '081234567897',
                'address'     => 'Jl. Diponegoro No. 20',
                'institution' => 'CV Sejahtera',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'guest_name'  => 'Fajar Hidayat',
                'phone'       => '081234567898',
                'address'     => 'Jl. Sudirman No. 15',
                'institution' => 'Universitas Nusantara',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('guests')->insertBatch($data);
    }
}
