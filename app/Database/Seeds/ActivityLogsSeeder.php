<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ActivityLogsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'user_id'    => 1,
                'action'     => 'CREATE',
                'entity'     => 'users',
                'entity_id'  => 1,
                'activity'   => 'Membuat akun administrator.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id'    => 1,
                'action'     => 'CREATE',
                'entity'     => 'users',
                'entity_id'  => 2,
                'activity'   => 'Membuat akun petugas.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id'    => 2,
                'action'     => 'CHECK_IN',
                'entity'     => 'visits',
                'entity_id'  => 1,
                'activity'   => 'Melakukan check-in kunjungan VIS-0001.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $this->db->table('activity_logs')->insertBatch($data);
    }
}
