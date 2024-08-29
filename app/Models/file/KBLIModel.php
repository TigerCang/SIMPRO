<?php

namespace App\Models\file;

use CodeIgniter\Model;

class KBLIModel extends Model
{
    protected $table      = 'm_kbli';
    protected $allowedFields = ['idunik', 'pilihan', 'kode', 'nama', 'pajak_id', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
