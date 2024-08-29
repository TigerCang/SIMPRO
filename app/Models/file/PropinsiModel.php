<?php

namespace App\Models\file;

use CodeIgniter\Model;

class PropinsiModel extends Model
{
    protected $table      = 'm_propinsi';
    protected $allowedFields = ['idunik', 'propinsi', 'kabupaten', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
