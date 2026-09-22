<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NotificationTemplatesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'recipient_type'    => 'guest',
                'notification_type' => 'registration',
                'template_message'  => 'Registrasi kunjungan Anda berhasil. Kode kunjungan: {visit_code}.',
                'active'            => true,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'recipient_type'    => 'guest',
                'notification_type' => 'check_in',
                'template_message'  => 'Kunjungan dengan kode {visit_code} telah dikonfirmasi. Selamat datang.',
                'active'            => true,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
            [
                'recipient_type'    => 'guest',
                'notification_type' => 'check_out',
                'template_message'  => 'Kunjungan dengan kode {visit_code} telah selesai. Terima kasih atas kunjungan Anda.',
                'active'            => true,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('notification_templates')->insertBatch($data);
    }
}
