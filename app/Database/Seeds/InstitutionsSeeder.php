<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InstitutionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'       => 'Buku Tamu Digital',
                'address'    => 'Jl. Ahma Yani No. 1',
                'phone'      => '081234567890',
                'email'      => 'admin@bukutamu.test',
                'logo'       => null,
                'active'     => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('institutions')->insertBatch($data);
    }
}
