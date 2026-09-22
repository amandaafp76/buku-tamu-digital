<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VisitsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [
            [
                'visit_code'     => 'VIS-0001',
                'guest_id'       => 1,
                'department_id'  => 1,
                'employee_id'    => 1,
                'purpose_id'     => 1,
                'identity_type'  => 'KTP',
                'identity_no'    => '3578010101010001',
                'group_size'     => 1,
                'arrival_time'   => $now,
                'check_in'       => $now,
                'check_out'      => null,
                'duration'       => null,
                'status'         => 'Masih Berkunjung',
                'qr_token'       => 'QR-VIS-0001',
                'consent'        => true,
                'photo_path'     => null,
                'signature_path' => null,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'visit_code'     => 'VIS-0002',
                'guest_id'       => 2,
                'department_id'  => 2,
                'employee_id'    => 3,
                'purpose_id'     => 2,
                'identity_type'  => 'SIM',
                'identity_no'    => '3578020202020002',
                'group_size'     => 2,
                'arrival_time'   => $now,
                'check_in'       => null,
                'check_out'      => null,
                'duration'       => null,
                'status'         => 'Menunggu',
                'qr_token'       => 'QR-VIS-0002',
                'consent'        => true,
                'photo_path'     => null,
                'signature_path' => null,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'visit_code'     => 'VIS-0003',
                'guest_id'       => 3,
                'department_id'  => 4,
                'employee_id'    => 5,
                'purpose_id'     => 4,
                'identity_type'  => 'KTP',
                'identity_no'    => '3578030303030003',
                'group_size'     => 3,
                'arrival_time'   => $now,
                'check_in'       => null,
                'check_out'      => null,
                'duration'       => null,
                'status'         => 'Menunggu',
                'qr_token'       => 'QR-VIS-0003',
                'consent'        => true,
                'photo_path'     => null,
                'signature_path' => null,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
        ];

        $this->db->table('visits')->insertBatch($data);
    }
}
