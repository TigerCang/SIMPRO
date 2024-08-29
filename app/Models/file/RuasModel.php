<?php

namespace App\Models\file;

use CodeIgniter\Model;

class RuasModel extends Model
{
    protected $table      = 'm_ruas';
    protected $allowedFields = ['idunik', 'pilihan', 'proyek_id', 'ruas_id', 'camp_id', 'kode', 'nama', 'jarak', 'catatan', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
