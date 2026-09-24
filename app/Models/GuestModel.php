<?php

namespace App\Models;

use CodeIgniter\Model;

class GuestModel extends Model
{
    protected $table      = 'guests';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'guest_name',
        'phone',
        'address',
        'institution',
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
