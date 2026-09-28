<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table      = 'employees';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'department_id',
        'employee_name',
        'phone',
        'active',
        'deleted_at',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $useSoftDeletes = true;
    protected $deletedField   = 'deleted_at';
}
