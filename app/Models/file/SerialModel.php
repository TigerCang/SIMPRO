<?php

namespace App\Models\file;

use CodeIgniter\Model;

class SerialModel extends Model
{
    protected $table      = 'm_serial';
    protected $allowedFields = ['idunik', 'barang_id', 'noseri', 'harga', 'alat_id', 'reparasi', 'is_confirm', 'is_aktif', 'updated_by', 'confirmed_by', 'activated_by'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
}
