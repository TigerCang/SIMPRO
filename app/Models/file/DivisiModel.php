<?php

namespace App\Models\file;

use CodeIgniter\Model;

class DivisiModel extends Model
{
    protected $table      = 'm_divisi';
    protected $allowedFields = [
        'idunik', 'pilihan', 'param', 'nama', 'kode', 'perusahaan_id', 'wilayah_id', 'divisi_id', 'nilai', 'setdef', 'is_confirm',
        'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
