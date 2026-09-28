<?php

namespace App\Validation;

class NotificationTemplateValidation
{
    public static function rules(bool $requireActive = false): array
    {
        return [
            'recipient_type' => [
                'label' => 'Penerima',
                'rules' => 'required|in_list[guest,employee]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid.',
                ],
            ],

            'notification_type' => [
                'label' => 'Jenis Notifikasi',
                'rules' => 'required|in_list[registration_success,check_in,visit_warning,check_out]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid.',
                ],
            ],

            'template_message' => [
                'label' => 'Isi Pesan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                ],
            ],

            'active' => [
                'label' => 'Status Aktif',
                'rules' => $requireActive
                    ? 'required|in_list[0,1]'
                    : 'in_list[0,1]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list'  => '{field} tidak valid.',
                ],
            ],
        ];
    }
}
