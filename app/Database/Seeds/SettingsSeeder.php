<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'institution_id'   => 1,
                'primary_color'    => '#2563EB',
                'require_photo'    => true,
                'require_signature' => true,
                'warning_limit'    => 60,
                'photo_size'       => 2048,
                'wakita_enabled'   => false,
                'wakita_api_url'   => null,
                'wakita_api_key'   => null,
                'wakita_sender'    => null,
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('settings')->insertBatch($data);
    }
}
