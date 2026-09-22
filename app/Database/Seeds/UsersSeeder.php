<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'      => 'admin',
                'password_hash' => password_hash('Admin123!', PASSWORD_DEFAULT),
                'role'          => 'administrator',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
                'active'        => true,
            ],
            [
                'username'      => 'petugas',
                'password_hash' => password_hash('Petugas123!', PASSWORD_DEFAULT),
                'role'          => 'petugas',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
                'active'        => true,
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
