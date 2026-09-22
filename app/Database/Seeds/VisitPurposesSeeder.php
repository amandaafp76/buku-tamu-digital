<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VisitPurposesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'purpose_name' => 'Pertemuan',
                'active'       => true,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'purpose_name' => 'Konsultasi',
                'active'       => true,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'purpose_name' => 'Pengurusan Dokumen',
                'active'       => true,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'purpose_name' => 'Kunjungan Kerja',
                'active'       => true,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('visit_purposes')->insertBatch($data);
    }
}
