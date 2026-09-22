<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartmentsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'        => 'Administrasi',
                'description' => 'Bagian administrasi dan pelayanan umum.',
                'active'      => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Keuangan',
                'description' => 'Bagian pengelolaan administrasi keuangan.',
                'active'      => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Kepegawaian',
                'description' => 'Bagian pengelolaan administrasi kepegawaian.',
                'active'      => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'name'        => 'Teknologi Informasi',
                'description' => 'Bagian pengelolaan teknologi informasi.',
                'active'      => true,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('departments')->insertBatch($data);
    }
}
