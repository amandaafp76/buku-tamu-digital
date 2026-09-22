<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmployeesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'department_id' => 1,
                'employee_name' => 'Budi Santoso',
                'phone'         => '081234567891',
                'active'        => true,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'department_id' => 1,
                'employee_name' => 'Siti Aminah',
                'phone'         => '081234567892',
                'active'        => true,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'department_id' => 2,
                'employee_name' => 'Andi Pratama',
                'phone'         => '081234567893',
                'active'        => true,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'department_id' => 3,
                'employee_name' => 'Dewi Lestari',
                'phone'         => '081234567894',
                'active'        => true,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'department_id' => 4,
                'employee_name' => 'Rizky Maulana',
                'phone'         => '081234567895',
                'active'        => true,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('employees')->insertBatch($data);
    }
}
