<?php

namespace App\Models\file;

use CodeIgniter\Model;

class DefakunModel extends Model
{
    protected $table      = 'def_akun';
    protected $allowedFields = [
        'idunik', 'perusahaan_id', 'wilayah_id', 'divisi_id', 'menu', 'submenu', 'kelompok', 'nama', 'nilai', 'akun1_id', 'akun2_id',
        'akun3_id', 'akun4_id', 'akun5_id', 'catatan', 'setdef', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
