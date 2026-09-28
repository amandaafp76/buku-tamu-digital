<?php

namespace App\Models;

use CodeIgniter\Model;

class InstitutionModel extends Model
{
    protected $table      = 'institutions';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $allowedFields = [
        'name',
        'address',
        'phone',
        'email',
        'logo',
        'active',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
