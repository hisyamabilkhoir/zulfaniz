<?php

namespace App\Models;

use CodeIgniter\Model;

class AdministratorModel extends Model
{
    protected $table      = 'administrators';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'name',
        'email',
        'phone',
        'address',
        'username',
        'password',
        'active',
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
