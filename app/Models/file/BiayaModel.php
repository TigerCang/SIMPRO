<?php

namespace App\Models\file;

use CodeIgniter\Model;

class BiayaModel extends Model
{
    protected $table      = 'm_biaya';
    protected $allowedFields = [
        'idunik', 'pilihan', 'induk_id', 'tipe_id', 'kode', 'matabayar', 'nama', 'satuan', 'level', 'akun_id', 'is_jumlah', 'is_confirm',
        'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'
    ];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
