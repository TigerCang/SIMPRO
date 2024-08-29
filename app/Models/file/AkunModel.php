<?php

namespace App\Models\file;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table      = 'm_akun';
    protected $allowedFields = ['idunik', 'kode', 'noakun', 'nama', 'level', 'kategori', 'induk_id', 'posisi', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
