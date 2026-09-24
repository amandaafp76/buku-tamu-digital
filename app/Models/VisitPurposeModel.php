<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitPurposeModel extends Model
{
    protected $table      = 'visit_purposes';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'purpose_name',
        'active',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
