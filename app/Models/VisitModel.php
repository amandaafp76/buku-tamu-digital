<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitModel extends Model
{
    protected $table      = 'visits';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'visit_code',
        'guest_id',
        'department_id',
        'employee_id',
        'purpose_id',
        'identity_type',
        'identity_no',
        'group_size',
        'arrival_time',
        'check_in',
        'check_out',
        'duration',
        'status',
        'qr_token',
        'consent',
        'photo_path',
        'signature_path',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
