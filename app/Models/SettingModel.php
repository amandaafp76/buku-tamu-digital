<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table      = 'settings';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'institution_id',
        'primary_color',
        'require_photo',
        'require_signature',
        'warning_limit',
        'photo_size',
        'wakita_enabled',
        'wakita_api_url',
        'wakita_api_key',
        'wakita_sender',
    ];

    protected $useTimestamps = true;

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
