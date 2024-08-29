<?php

namespace App\Models\file;

use CodeIgniter\Model;

class CampModel extends Model
{
    protected $table      = 'm_camp';
    protected $allowedFields = ['idunik', 'perusahaan_id', 'wilayah_id', 'divisi_id', 'kode', 'nama', 'alamat', 'catatan', 'is_jual', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
