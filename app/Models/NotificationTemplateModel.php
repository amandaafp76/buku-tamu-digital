<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationTemplateModel extends Model
{
    protected $table      = 'notification_templates';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'recipient_type',
        'notification_type',
        'template_message',
        'active',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
